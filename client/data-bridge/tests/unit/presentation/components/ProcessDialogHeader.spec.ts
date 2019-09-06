import ProcessDialogHeader from '@/presentation/components/ProcessDialogHeader.vue';
import { shallowMount } from '@vue/test-utils';

describe( 'ProcessDialogHeader', () => {
	it( 'is a Vue instance', () => {
		const wrapper = shallowMount( ProcessDialogHeader );
		expect( wrapper.isVueInstance() ).toBeTruthy();
	} );

	it( 'renders correctly without slots filled', () => {
		const wrapper = shallowMount( ProcessDialogHeader );
		expect( wrapper.element ).toMatchSnapshot();
	} );

	it( 'renders correctly with all props and slots filled', () => {
		const wrapper = shallowMount( ProcessDialogHeader, {
			slots: {
				default: '<button>primary action</button>',
				safeAction: '<button>safe action</button>',
			},
			propsData: { title: 'title' },
		} );
		expect( wrapper.element ).toMatchSnapshot();
	} );

	it( 'gets content through the default slot', () => {
		const message = 'primary action';
		const wrapper = shallowMount( ProcessDialogHeader, {
			slots: { default: `<a class="mockPrimaryActionButton">${message}</a>` },
		} );
		expect( wrapper.find( 'a' ).text() ).toBe( message );
	} );

	it( 'gets content through the safeAction slot', () => {
		const message = 'safe action';
		const wrapper = shallowMount( ProcessDialogHeader, {
			slots: { safeAction: `<a class="mockSafeActionButton">${message}</a>` },
		} );
		expect( wrapper.find( 'a' ).text() ).toBe( message );
	} );

	it( 'gets title through the respective prop', () => {
		const message = 'some message';
		const wrapper = shallowMount( ProcessDialogHeader, {
			propsData: { title: message },
		} );
		expect( wrapper.find( 'h1' ).text() ).toBe( message );
	} );
} );