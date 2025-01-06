import { createStore } from 'vuex';
import TechniquesList from '../resources/js/Components/Techniques/TechniquesList.vue';

const mockStore = createStore({
    modules: {
        techniques: {
            namespaced: true,
            state: {
                techniques: [
                    {
                        id: 1,
                        name: 'Dynamic Move',
                        difficulty_level: 'Intermediate',
                        description: 'A powerful, controlled jump to reach a hold.',
                        image: 'dynamic-move.jpg'
                    },
                    {
                        id: 2,
                        name: 'Hell Hook',
                        difficulty_level: 'Advanced',
                        description: 'Using your heel to hook a hold for stability.',
                        image: 'heel-hook.jpg'
                    },
                ],
                loading: false,
            },
            getters: {
                techniques: (state) => state.techniques,
                loading: (state) => state.loading,
            },
            actions: {
                fetchTechniques: () => {
                    console.log('Mock fetchTeachniques action called');
                },
            },
        },
    }
})

export default {
    title: 'Components/TechniquesList',
    component: TechniquesList,
};

const Template = (args) => ({
    components: { TechniquesList },
    setup() {
        return { args };
    },
    template: '<TechniquesList />',
    store: mockStore,
});

export const Default = Template.bind({});