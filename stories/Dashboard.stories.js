import Dashboard from '../resources/js/Pages/Dashboard.vue';
import { createMockStore } from '../resources/js/store/mocks/techniques';


export default {
  title: 'Pages/Dashboard',
  component: Dashboard,
};

const Template = (args) => ({
  components: { Dashboard },
  setup() {
    return { args };
  },
  template: '<Dashboard />',
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
