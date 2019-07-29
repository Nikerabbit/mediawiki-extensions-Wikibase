import Vue from 'vue';
import Entities from '@/mock-data/data/Q42.data.json';
import EditFlow from '@/definitions/EditFlow';
import SpecialPageEntityRepository from '@/data-access/SpecialPageEntityRepository';
import getOrEnforceUrlParameter from '@/mock-data/getOrEnforceUrlParameter';
import { services } from '@/services';
import App from '@/presentation/App.vue';

Vue.config.productionTip = false;

const information = {
	entityId: 'Q42',
	propertyId: getOrEnforceUrlParameter( 'propertyId', 'P349' ) as string,
	editFlow: EditFlow.OVERWRITE,
};

services.setEntityRepository(
	new SpecialPageEntityRepository(
		{
			get: () => {
				return Entities;
			},
		} as any, // eslint-disable-line @typescript-eslint/no-explicit-any
		'',
	),
);

new App( { propsData: information } ).$mount( '#data-bridge-container' );