import { test, expect } from '@playwright/test';

test('should have the correct page title', async ({ page }) => {
  await page.goto('http://127.0.0.1:8000/'); 
  await expect(page).toHaveTitle('Laravel');
});
