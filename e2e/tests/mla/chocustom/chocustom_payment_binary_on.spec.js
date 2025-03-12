import { test, expect } from "@playwright/test";
import { mla } from "../../../data/meli_sites";
import { fillStepsToCheckout } from "../../../flows/fill_steps_to_checkout";
import payWithCard from "../../../flows/pay_with_card";

const { url, credit_card_scenarios, debit_card_scenarios, guestUserMLA } = mla;
const { PENDING: CREDIT_PENDING } = credit_card_scenarios;
const { PENDING: DEBIT_PENDING } = debit_card_scenarios;

test('Given guest user with master credit card, When payment is pending and binary is on, Should show decline message', async ({page}) => {
  await fillStepsToCheckout(page, url, guestUserMLA);
  await payWithCard(page, CREDIT_PENDING.master, CREDIT_PENDING.formMLA);

  await expect(page.locator('div.wc-block-components-notices .wc-block-store-notice')).toHaveText(/The card issuing bank declined the payment/i);
});

test('Given guest user with master debit card, When payment is pending and binary is on, Should show decline message', async ({page}) => {
  await fillStepsToCheckout(page, url, guestUserMLA);
  await payWithCard(page, DEBIT_PENDING.elo, DEBIT_PENDING.formMLA);

  await expect(page.locator('div.wc-block-components-notices .wc-block-store-notice')).toHaveText(/The card issuing bank declined the payment/i);
});