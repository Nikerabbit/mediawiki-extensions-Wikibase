import Vue from 'vue';
import Vuex, { Store, StoreOptions } from 'vuex';
import ApplicationStatus from '@/store/ApplicationStatus';
import Application from '@/store/Application';
import { actions } from '@/store/actions';
import { getters } from '@/store/getters';
import { mutations } from '@/store/mutations';
import createEntity from './entity';
import {
	NS_ENTITY,
} from '@/store/namespaces';

Vue.use( Vuex );

export function createStore(): Store<Application> {
	const state: Application = {
		targetProperty: '',
		editFlow: '',
		applicationStatus: ApplicationStatus.INITIALIZING,
	};

	const storeBundle: StoreOptions<Application> = {
		state,
		actions,
		getters,
		mutations,
		strict: process.env.NODE_ENV !== 'production',
		modules: {
			[ NS_ENTITY ]: createEntity(),
		},
	};

	return new Store<Application>( storeBundle );
}