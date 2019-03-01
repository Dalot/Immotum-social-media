import { shallow, mount } from 'vue-test-utils';
import expect from 'expect';
import VueApp from '../../resources/views/Vue/App.vue';
import moxios from 'moxios'


describe('VueApp', () => {
    beforeEach(() => {
        moxios.install(axios);
    });

    afterEach(() => {
        moxios.uninstall(axios);
    });
    
    it('renders the correct title on the page', () => {
        let wrapper = shallow(TodoList);
        expect(wrapper.html()).anything();
    });
});