import { defineConfig, devices } from '@playwright/test';

export default defineConfig({
  testDir: './tests/playwright', 
  use: {
    browserName: 'chromium',
    headless: true,
  },
  projects: [
    {
      name: 'firefox',
      use: { ...devices['Desktop Firefox'] },
    },
    {
      name: 'webkit',
      use: { ...devices['Desktop Safari'] },
    },
  ],
});
