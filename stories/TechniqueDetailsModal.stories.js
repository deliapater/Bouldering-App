import { action } from '@storybook/addon-actions';
import TechniqueDetailsModal from "../resources/js/Components/Techniques/TechniqueDetailsModal.vue";
import TechniqueCard from "../resources/js/Components/Techniques/TechniqueCard.vue";  
import { createMockStore } from "../resources/js/store/mocks/techniques";

export default {
  title: 'Components/TechniqueDetailsModal',
  component: TechniqueDetailsModal,
  argTypes: {
    technique: { control: 'object' },
    close: { action: 'Modal Closed' }
  },
};

const mockTechnique = {
  id: 1,
  name: 'Bouldering Basics',
  description: 'Learn the basics of bouldering.',
  steps_to_practice: 'Start with easy routes and practice footwork.',
  image: 'crimp.jpg',
  gear: [
    {
      id: 1,
      name: 'Climbing Shoes',
      category: 'Footwear',
      description: 'Specialized shoes for climbing.',
    },
    {
      id: 2,
      name: 'Chalk Bag',
      category: 'Chalk',
      description: 'Holds chalk to keep hands dry.',
    },
  ],
};

const Template = (args) => ({
  components: { TechniqueDetailsModal, TechniqueCard },
  setup() {
    return { args };
  },
  template: `
    <v-app>
      <v-main>
        <TechniqueDetailsModal 
          v-bind="args" 
          @close="args.close" 
        />
      </v-main>
    </v-app>
  `,
});

Template.decorators = [
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

export const Default = Template.bind({});
Default.args = {
  technique: mockTechnique,
  close: action('Modal Closed'),
};
