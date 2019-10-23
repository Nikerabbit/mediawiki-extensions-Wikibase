import { NS_ENTITY, NS_STATEMENTS } from '@/store/namespaces';
import { STATEMENTS_IS_AMBIGUOUS } from '@/store/entity/statements/getterTypes';
import { mainSnakGetterTypes } from '@/store/entity/statements/mainSnakGetterTypes';
import validateBridgeApplicability from '@/store/validateBridgeApplicability';
import newMockStore from '@wmde/vuex-helpers/dist/newMockStore';
import { getter } from '@wmde/vuex-helpers/dist/namespacedStoreMethods';
import { ENTITY_ID } from '@/store/entity/getterTypes';

const defaultEntity = 'Q815';
const defaultProperty = 'P4711';

function mockedStore(
	gettersOverride?: any,
	entityId: string = defaultEntity,
	targetProperty: string = defaultProperty,
): any {
	return newMockStore( {
		state: {
			targetProperty,
		},
		getters: {
			...{
				get [ getter( NS_ENTITY, ENTITY_ID ) ]() {
					return entityId;
				},
				[ getter(
					NS_ENTITY,
					NS_STATEMENTS,
					STATEMENTS_IS_AMBIGUOUS,
				) ]: jest.fn( () => false ),
				[ getter(
					NS_ENTITY,
					NS_STATEMENTS,
					mainSnakGetterTypes.snakType,
				) ]: jest.fn( () => 'value' ),
				[ getter(
					NS_ENTITY,
					NS_STATEMENTS,
					mainSnakGetterTypes.dataValueType,
				) ]: jest.fn( () => 'string' ),
			}, ...gettersOverride,
		},
	} );
}

describe( 'validateBridgeApplicability', () => {

	it( 'returns true if applicable', () => {
		const context = mockedStore( {}, defaultEntity, defaultProperty );

		expect( validateBridgeApplicability(
			context,
			{
				entityId: defaultEntity,
				propertyId: defaultProperty,
				index: 0,
			},
		) ).toBe( true );
		expect(
			context.getters[ getter(
				NS_ENTITY,
				NS_STATEMENTS,
				STATEMENTS_IS_AMBIGUOUS,
			) ],
		).toHaveBeenCalledWith( defaultEntity, defaultProperty );
		expect(
			context.getters[ getter(
				NS_ENTITY,
				NS_STATEMENTS,
				mainSnakGetterTypes.snakType,
			) ],
		).toHaveBeenCalledWith( {
			entityId: defaultEntity,
			propertyId: defaultProperty,
			index: 0,
		} );
		expect(
			context.getters[ getter(
				NS_ENTITY,
				NS_STATEMENTS,
				mainSnakGetterTypes.dataValueType,
			) ],
		).toHaveBeenCalledWith( {
			entityId: defaultEntity,
			propertyId: defaultProperty,
			index: 0,
		} );
	} );

	it( 'returns false on ambiguous statements', () => {
		const context = mockedStore( {
			[ getter(
				NS_ENTITY,
				NS_STATEMENTS,
				STATEMENTS_IS_AMBIGUOUS,
			) ]: jest.fn( () => true ),
		} );

		expect( validateBridgeApplicability(
			context,
			{ entityId: defaultEntity, propertyId: defaultProperty, index: 0 },
		) ).toBe( false );
	} );

	it( 'returns false for non-value snak types', () => {
		const context = mockedStore( {
			[ getter(
				NS_ENTITY,
				NS_STATEMENTS,
				mainSnakGetterTypes.snakType,
			) ]: jest.fn( () => 'novalue' ),
		} );

		expect( validateBridgeApplicability( context,
			{ entityId: defaultEntity, propertyId: defaultProperty, index: 0 } ) ).toBe( false );
	} );

	it( 'returns false for non-string data types', () => {
		const context = mockedStore( {
			[ getter(
				NS_ENTITY,
				NS_STATEMENTS,
				mainSnakGetterTypes.dataValueType,
			) ]: jest.fn( () => 'noStringType' ),
		} );

		expect( validateBridgeApplicability(
			context,
			{ entityId: defaultEntity, propertyId: defaultProperty, index: 0 },
		) ).toBe( false );
	} );
} );