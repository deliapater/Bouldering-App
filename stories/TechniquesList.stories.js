import TechniquesList from '../resources/js/Components/Techniques/TechniquesList.vue';
import { createMockStore } from '../resources/js/store/mocks/techniques';

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
});

export const Default = Template.bind({});

Default.decorators = [
  (story) => {
    const mockStore = createMockStore();
    mockStore.dispatch('techniques/fetchTechniques');

    return {
      components: { story },
      setup() {
        return { store: mockStore };
      },
      template: `
        <v-app>
          <v-main>
            <story />
          </v-main>
        </v-app>
      `,
    };
  },
];
