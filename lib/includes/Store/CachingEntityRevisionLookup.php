<?php

namespace Wikibase\Lib\Store;

use BagOStuff;
use Wikibase\DataModel\Entity\EntityId;
use Wikibase\DataModel\Entity\EntityRedirect;
use Wikimedia\Assert\Assert;

/**
 * Implementation of EntityLookup that caches the obtained entities.
 *
 * @license GPL-2.0+
 * @author Daniel Kinzler
 */
class CachingEntityRevisionLookup implements EntityRevisionLookup, EntityStoreWatcher {

	/**
	 * @var EntityRevisionLookup
	 */
	private $lookup;

	/**
	 * The cache to use for caching entities.
	 *
	 * @var BagOStuff
	 */
	private $cache;

	/**
	 * @var int
	 */
	private $cacheTimeout;

	/**
	 * The key prefix to use when caching entities in memory.
	 *
	 * @var string
	 */
	private $cacheKeyPrefix;

	/**
	 * @var bool
	 */
	private $shouldVerifyRevision = false;

	/**
	 * @param EntityRevisionLookup $entityRevisionLookup The lookup to use
	 * @param BagOStuff $cache The cache to use
	 * @param int $cacheDuration Cache duration in seconds. Defaults to 3600 (1 hour).
	 * @param string $cacheKeyPrefix The key prefix to use for constructing cache keys.
	 *         Defaults to "wbentity". There should be no reason to change this.
	 */
	public function __construct(
		EntityRevisionLookup $entityRevisionLookup,
		BagOStuff $cache,
		$cacheDuration = 3600,
		$cacheKeyPrefix = 'wbentity'
	) {
		$this->lookup = $entityRevisionLookup;
		$this->cache = $cache;
		$this->cacheTimeout = $cacheDuration;
		$this->cacheKeyPrefix = $cacheKeyPrefix;
	}

	/**
	 * Determine whether the revision of the cached entity should be verified against the
	 * current revision in the underlying lookup.
	 *
	 * @param bool $shouldVerifyRevision
	 */
	public function setVerifyRevision( $shouldVerifyRevision ) {
		$this->shouldVerifyRevision = $shouldVerifyRevision;
	}

	/**
	 * Returns a cache key suitable for the given entity
	 *
	 * @param EntityId $entityId
	 *
	 * @return string
	 */
	private function getCacheKey( EntityId $entityId ) {
		$cacheKey = $this->cacheKeyPrefix . ':' . $entityId->getSerialization();

		return $cacheKey;
	}

	/**
	 * @see   EntityLookup::getEntity
	 *
	 * @note: If this lookup is configured to verify revisions, getLatestRevisionId()
	 * will be called on the underlying lookup to check whether the cached revision is
	 * still the latest. Otherwise, any cached revision will be used if $revisionId=0.
	 *
	 * @param EntityId $entityId
	 * @param int $revisionId The desired revision id, or 0 for the latest revision.
	 * @param string $mode LATEST_FROM_REPLICA, LATEST_FROM_REPLICA_WITH_FALLBACK or
	 *        LATEST_FROM_MASTER.
	 *
	 * @throws StorageException
	 * @return EntityRevision|null
	 */
	public function getEntityRevision(
		EntityId $entityId,
		$revisionId = 0,
		$mode = self::LATEST_FROM_REPLICA
	) {
		Assert::parameterType( 'integer', $revisionId, '$revisionId' );
		Assert::parameterType( 'string', $mode, '$mode' );

		$key = $this->getCacheKey( $entityId );

		/** @var EntityRevision $entityRevision */
		$entityRevision = $this->cache->get( $key );

		if ( $entityRevision !== false ) {
			if ( $revisionId === 0 && $this->shouldVerifyRevision ) {
				$latestRevision = $this->lookup->getLatestRevisionId( $entityId, $mode );

				if ( $latestRevision === false ) {
					// entity no longer exists!
					$entityRevision = null;
				} else {
					$revisionId = $latestRevision;
				}
			}

			if ( $revisionId > 0 && $entityRevision && $entityRevision->getRevisionId() !== $revisionId ) {
				$entityRevision = false;
			}
		}

		if ( $entityRevision === false ) {
			$entityRevision = $this->fetchEntityRevision( $entityId, $revisionId, $mode );
		}

		return $entityRevision;
	}

	/**
	 * Fetches the EntityRevision and updates the cache accordingly.
	 *
	 * @param EntityId $entityId
	 * @param int $revisionId
	 * @param string $mode
	 *
	 * @throws StorageException
	 * @return EntityRevision|null
	 */
	private function fetchEntityRevision( EntityId $entityId, $revisionId, $mode ) {
		$key = $this->getCacheKey( $entityId );
		$entityRevision = $this->lookup->getEntityRevision( $entityId, $revisionId, $mode );

		if ( $revisionId === 0 ) {
			if ( $entityRevision === null ) {
				$this->cache->delete( $key );
			} else {
				$this->cache->set( $key, $entityRevision, $this->cacheTimeout );
			}
		}

		return $entityRevision;
	}

	/**
	 * @see EntityRevisionLookup::getLatestRevisionId
	 *
	 * @note: If this lookup is configured to verify revisions, this just delegates
	 * to the underlying lookup. Otherwise, it may return the ID of a cached
	 * revision.
	 *
	 * @param EntityId $entityId
	 * @param string $mode
	 *
	 * @return int|false
	 */
	public function getLatestRevisionId( EntityId $entityId, $mode = self::LATEST_FROM_REPLICA ) {
		// If we do not need to verify the revision, and the revision isn't
		// needed for an update, we can get the revision from the cached object.
		// XXX: whether this is actually quicker depends on the cache.
		if ( ! ( $this->shouldVerifyRevision || $mode === self::LATEST_FROM_MASTER ) ) {
			$key = $this->getCacheKey( $entityId );
			/** @var EntityRevision $entityRevision */
			$entityRevision = $this->cache->get( $key );

			if ( $entityRevision ) {
				return $entityRevision->getRevisionId();
			}
		}

		return $this->lookup->getLatestRevisionId( $entityId, $mode );
	}

	/**
	 * Notifies the cache that an Entity was created or updated.
	 *
	 * @param EntityRevision $entityRevision
	 */
	public function entityUpdated( EntityRevision $entityRevision ) {
		$key = $this->getCacheKey( $entityRevision->getEntity()->getId() );
		$this->cache->set( $key, $entityRevision, $this->cacheTimeout );
	}

	/**
	 * Notifies the cache that a redirect was created or updated.
	 *
	 * @param EntityRedirect $entityRedirect
	 * @param int $revisionId
	 */
	public function redirectUpdated( EntityRedirect $entityRedirect, $revisionId ) {
		//TODO: cache redirects
		$key = $this->getCacheKey( $entityRedirect->getEntityId() );
		$this->cache->delete( $key );
	}

	/**
	 * Notifies the cache that an Entity or redirect was deleted.
	 *
	 * @param EntityId $entityId
	 */
	public function entityDeleted( EntityId $entityId ) {
		$key = $this->getCacheKey( $entityId );
		$this->cache->delete( $key );
		// XXX: if $this->lookup supports purging, purge?
	}

}
