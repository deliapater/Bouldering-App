import { setup } from '@storybook/vue3';
import vuetify from '../resources/js/plugins/vuetify';
import '../resources/css/app.css';
import { createMockStore } from '../resources/js/store/mocks/techniques';

const mockStore = createMockStore();

setup((app) => {
  app.use(vuetify);
  app.use(mockStore);
});

const preview = {
  parameters: {
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/i,
      },
    },
  },
  decorators: [
    (story) => ({
      components: { story },
      setup() {
        return {};
      },
      template: `
      <v-app>
        <v-main>
          <story />
        </v-main>
      </v-app>
      `,
    }),
  ],
};

export default preview;
