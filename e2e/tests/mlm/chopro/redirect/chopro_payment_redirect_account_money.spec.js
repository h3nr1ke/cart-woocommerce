import { test, expect } from '@playwright/test';
import { mlm } from '../../../../data/meli_sites';
import { fillStepsToCheckoutMulti } from '../../../../flows/fill_steps_to_checkout';
import {
  select_cho_pro,
  cho_pro_redirect_login,
  cho_pro_redirect_logged,
  wait_redirect_page_load,
  return_to_congrats_page
} from '../../../../flows/cho_pro/mlm/pay_with_cho_pro.spec';

const { url, loggedUserMLM } = mlm;

test('test payment with account money', async ({ page }) => {
  await fillStepsToCheckoutMulti(page, url, loggedUserMLM, '2');
  await select_cho_pro(page);
  await page.waitForTimeout(1000);
  await wait_redirect_page_load(page);
  await cho_pro_redirect_login(page, loggedUserMLM);
  await cho_pro_redirect_logged(page, 'Dinero disponible en Mercado');
  await page.waitForTimeout(1000);
  await return_to_congrats_page(page);
  await expect(page.locator('#main')).toHaveText(/Order number:/i);
});