import { storiesOf } from '@storybook/vue';
import { boolean, number } from '@storybook/addon-knobs';
import Loading from '@/presentation/components/Loading';

function getLoadingProps() {
	return {
		TIME_UNTIL_CONSIDERED_SLOW: {
			default: number( 'time until considered slow (ms)', 1000 ),
		},
		MINIMUM_TIME_OF_PROGRESS_ANIMATION: {
			default: number( 'minimum time of progress animation (ms)', 500 ),
		},
	};
}

storiesOf( 'Loading', module )
	.addParameters( { component: Loading } )
	.add( 'initializing', () => ( {
		components: { Loading },
		props: {
			isInitializing: {
				default: boolean( 'Initializing', true ),
			},
			...getLoadingProps(),
		},
		template:
			`<Loading
				:is-initializing="isInitializing"
				:is-saving="false"
				:TIME_UNTIL_CONSIDERED_SLOW="TIME_UNTIL_CONSIDERED_SLOW"
				:MINIMUM_TIME_OF_PROGRESS_ANIMATION="MINIMUM_TIME_OF_PROGRESS_ANIMATION"
			>Content which may be slow</Loading>`,
	} ) )
	.add( 'saving', () => ( {
		components: { Loading },
		props: {
			isSaving: {
				default: boolean( 'Saving', true ),
			},
			...getLoadingProps(),
		},
		template:
			`<Loading
				:is-initializing="false"
				:is-saving="isSaving"
				:TIME_UNTIL_CONSIDERED_SLOW="TIME_UNTIL_CONSIDERED_SLOW"
				:MINIMUM_TIME_OF_PROGRESS_ANIMATION="MINIMUM_TIME_OF_PROGRESS_ANIMATION"
			>
				<h3>I am under the loading bar</h3>
				<div style="max-width: 50em">
					Lorem-ipsum-dolor-sit-amet,-consetetur-sadipscing-elitr,-sed-diam-nonumy-eirmod-tempor-invidunt-ut-labore-et-dolore-magna-aliquyam-erat,-sed-diam-voluptua.-At-vero-eos-et-accusam-et-justo-duo-dolores-et-ea-rebum.-Stet-clita-kasd-gubergren,-no-sea-takimata-sanctus-est-Lorem-ipsum-dolor-sit-amet.-Lorem-ipsum-dolor-sit-amet,-consetetur-sadipscing-elitr,-sed-diam-nonumy-eirmod-tempor-invidunt-ut-labore-et-dolore-magna-aliquyam-erat,-sed-diam-voluptua.-At-vero-eos-et-accusam-et-justo-duo-dolores-et-ea-rebum.-Stet-clita-kasd-gubergren,-no-sea-takimata-sanctus-est-Lorem-ipsum-dolor-sit-amet.-Lorem-ipsum-dolor-sit-amet,-consetetur-sadipscing-elitr,-sed-diam-nonumy-eirmod-tempor-invidunt-ut-labore-et-dolore-magna-aliquyam-erat,-sed-diam-voluptua.-At-vero-eos-et-accusam-et-justo-duo-dolores-et-ea-rebum.-Stet-clita-kasd-gubergren,-no-sea-takimata-sanctus-est-Lorem-ipsum-dolor-sit-amet. Lorem-ipsum-dolor-sit-amet,-consetetur-sadipscing-elitr,-sed-diam-nonumy-eirmod-tempor-invidunt-ut-labore-et-dolore-magna-aliquyam-erat,-sed-diam-voluptua.-At-vero-eos-et-accusam-et-justo-duo-dolores-et-ea-rebum.-Stet-clita-kasd-gubergren,-no-sea-takimata-sanctus-est-Lorem-ipsum-dolor-sit-amet.-Lorem-ipsum-dolor-sit-amet,-consetetur-sadipscing-elitr,-sed-diam-nonumy-eirmod-tempor-invidunt-ut-labore-et-dolore-magna-aliquyam-erat,-sed-diam-voluptua.-At-vero-eos-et-accusam-et-justo-duo-dolores-et-ea-rebum.-Stet-clita-kasd-gubergren,-no-sea-takimata-sanctus-est-Lorem-ipsum-dolor-sit-amet.-Lorem-ipsum-dolor-sit-amet,-consetetur-sadipscing-elitr,-sed-diam-nonumy-eirmod-tempor-invidunt-ut-labore-et-dolore-magna-aliquyam-erat,-sed-diam-voluptua.-At-vero-eos-et-accusam-et-justo-duo-dolores-et-ea-rebum.-Stet-clita-kasd-gubergren,-no-sea-takimata-sanctus-est-Lorem-ipsum-dolor-sit-amet.
				</div>
			</Loading>`,
	} ) );
