<?php

/**
 * Part of Woo Mercado Pago Module
 * Author - Mercado Pago
 * Developer
 * Copyright - Copyright(c) MercadoPago [https://www.mercadopago.com]
 * License - https://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 *
 * @package MercadoPago
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<div class="mp-settings">
	<div class="mp-settings-header">
		<img class="mp-settings-header-img" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/header-settings.png', plugin_dir_path(__FILE__))); ?>">
		<img class="mp-settings-header-logo" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/mercadopago-logo.png', plugin_dir_path(__FILE__))); ?>">
		<hr class="mp-settings-header-hr" />
		<p>Aceite <b>pagamentos no ato</b> com<br />
			toda a <b>segurança</b> Mercado Pago</p>
	</div>
	<div class="mp-settings-requirements">
		<div class="mp-container">
			<div class="mp-block mp-block-requirements mp-settings-margin-right">
				<p class="mp-settings-font-color mp-settings-title-requirements-font-size">Requisitos técnicos</p>
				<div class="mp-inner-container">
					<div>
						<p class="mp-settings-font-color mp-settings-subtitle-font-size">SSL</p>
						<img class="mp-icon" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">
					</div>
					<div>
						<img class="mp-credential-input-success">
					</div>
				</div>
				<hr>
				<div class="mp-inner-container">
					<div>
						<p class="mp-settings-font-color mp-settings-subtitle-font-size">Extensões GD</p>
						<img class="mp-icon" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">
					</div>
					<div>
						<img class="mp-credential-input-success">
					</div>
				</div>
				<hr>
				<div class="mp-inner-container">
					<div>
						<p class="mp-settings-font-color mp-settings-subtitle-font-size">Curl</p>
						<img class="mp-icon" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">
					</div>
					<div>
						<img class="mp-credential-input-success">
					</div>
				</div>
			</div>
			<div class="mp-block mp-block-flex mp-settings-margin-left mp-settings-margin-right">
				<div class="mp-inner-container-settings">
					<div>
						<p class="mp-settings-font-color mp-settings-title-font-size">Recebimentos e parcelamento</p>
						<p class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color">Escolha <b>quando quer receber o dinheiro</b> das vendas e se quer oferecer
							<b>parcelamento sem
								juros</b> aos clientes.
						</p>
					</div>
					<div>
						<button class="mp-button">Ajustar prazos e taxas </button>
					</div>
				</div>
			</div>
			<div class="mp-block mp-block-flex mp-block-manual mp-settings-margin-left">
				<div class="mp-inner-container-settings">
					<div>
						<p class="mp-settings-font-color mp-settings-title-font-size">Dúvidas?</p>
						<p class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color">Revise o passo a passo de <span>como integrar o Plugin do Mercado Pago</span> no nosso site de
							desenvolvedores. </p>
					</div>
					<div>
						<button class="mp-button mp-button-light-blue"> Manual do plugin </button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr class="mp-settings-hr" />
	<div class="mp-settings-credentials">
		<div class="mp-settings-badge-spacing">
			<div class="mp-settings-badge-align">
				<div class="mp-settings-align-div">
					<div><span class="mp-settings-font-color mp-settings-title-blocks mp-settings-margin-right">1. Integre a loja com o Mercado Pago</span></div>

					<img class="mp-icon mp-settings-margin-left mp-settings-margin-right" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">
				</div>
			</div>

			<div class="mp-settings-margin-left">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-open.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>
		<div class="mp-settings-block-align-top">
			<div>
				<p class="mp-settings-subtitle-font-size mp-settings-title-color">Para habilitar e testar e vendas, você deve <b>copiar e colar suas credenciais abaixo.</b></p>
			</div>
			<div>
				<button class="mp-button mp-button-light-blue"> Consultar credenciais </button>
			</div>
			<div class="mp-container">
				<div class="mp-block mp-block-flex mp-settings-margin-right">
					<p class="mp-settings-title-font-size"><b>Credenciais de teste</b></p>
					<p class="mp-settings-label mp-settings-title-color mp-settings-margin-bottom">Habilitam os checkouts Mercado Pago para testes de compras na loja.</p>
					<fieldset class="mp-settings-fieldset">
						<legend clas="mp-settings-label mp-settings-font-color">Public Key</legend>
						<input class="mp-settings-input" type="text" placeholder="Cole aqui sua Public Key">
					</fieldset>
					<fieldset>
						<legend clas="mp-settings-label">Access token</legend>
						<input class="mp-settings-input" type="text" placeholder="Cole aqui seu Access Token">
					</fieldset>
				</div>
				<div class="mp-block mp-block-flex mp-settings-margin-left">
					<p class="mp-settings-title-font-size"><b>Credenciais de produção</b></p>
					<p class="mp-settings-label mp-settings-title-color mp-settings-margin-bottom">Habilitam os checkouts Mercado Pago para receber pagamentos reais na loja.</p>
					<fieldset class="mp-settings-fieldset">
						<legend clas="mp-settings-label">Public Key</legend>
						<input class="mp-settings-input" type="text" placeholder="Cole aqui seu Access Token">
					</fieldset>
					<fieldset>
						<legend clas="mp-settings-label">Access token</legend>
						<input class="mp-settings-input" type="text" placeholder="Cole aqui seu Access Token">
					</fieldset>
				</div>
			</div>
			<button class="mp-button"> Salvar e continuar </button>
		</div>
	</div>

	<hr class="mp-settings-hr" />
	<div class="mp-settings-credentials">
		<div class="mp-settings-badge-spacing">
			<div class="mp-settings-badge-align">
				<div class="mp-settings-align-div">
					<div><span class="mp-settings-font-color mp-settings-title-blocks mp-settings-margin-right">2. Personalize seu negócio</span></div>

					<img class="mp-icon mp-settings-margin-left mp-settings-margin-right" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">
				</div>
			</div>

			<div class="mp-settings-margin-left">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-open.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>
		<p class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color">Preencha as informações a seguir para ter uma melhor experiência e oferecer mais informações aos clientes</p>
		<div class="mp-container">
			<div class="mp-block mp-block-flex mp-settings-margin-right" style="flex-direction:column; justify-content:space-between">
				<div>
					<p class="mp-settings-title-font-size"><b>Informações sobre sua loja</b></p>
				</div>
				<div class="mp-settings-standard-margin">
					<fieldset>

						<legend class="mp-settings-label">Nome da sua loja nas faturas do cliente</legend>
						<input type="text" class="mp-settings-input" placeholder="Ex.:Loja da Maria">
						<span class="mp-settings-helper">Se o campo estiver vazio, a compra do cliente será identificada como Mercado Pago.</span>

					</fieldset>
				</div>
				<div class="mp-settings-standard-margin">
					<fieldset>

						<legend class="mp-settings-label">Identificação em Atividades do Mercado Pago</legend>
						<input type="text" class="mp-settings-input" placeholder="Ex.:Loja da Maria">
						<span class="mp-settings-helper">Nas Ativades voce verá o termo inserido antes do númer o do pedido</span>

					</fieldset>
				</div>
				<div class="mp-settings-standard-margin">
					<fieldset>

						<legend class="mp-settings-label">Nome da sua loja nas faturas do cliente</legend>
						<select name="select" class="mp-settings-input">
							<option value="valor1">Valor 1</option>
							<option value="valor2" selected>Valor 2</option>
							<option value="valor3">Valor 3</option>
						</select>
					</fieldset>
				</div>
			</div>

			<div class="mp-block mp-block-flex mp-block-manual mp-settings-margin-left">
				<div>
					<p class="mp-settings-title-font-size"><b>Opções avançadas de integração (opcional)</b></p>
				</div>
				<p class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color">
					Para mais integração da sua loja com o Mercado Pago (IPN, Parceiros Certificados, Modo Debug)
				</p>
				<div>
					<p class="mp-settings-blue-text">
						Ver opções avançadas
					</p>
					<div>
						<div class="mp-settings-standard-margin">
							<fieldset>

								<legend class="mp-settings-label">URL para IPN</legend>
								<input type="text" class="mp-settings-input" placeholder="Ex.: https://examples.com/my-custom-ipn-url">
								<span class="mp-settings-helper">Insira a URL para receber notificações de pagamento. Confira mais informções nos <span class="mp-settings-blue-text"> manuais.</span>

							</fieldset>
						</div>
						<div class="mp-settings-standard-margin">
							<fieldset>

								<legend class="mp-settings-label">integrator_id</legend>
								<input type="text" class="mp-settings-input" placeholder="Ex.: 14987126498">
								<span class="mp-settings-helper">Se você é Parceiro certificado do Mercado Pago, não esqueça de inserir seu integrator_id.</span><br>
								<span class="mp-settings-helper">Se você não possui o código, <span class="mp-settings-blue-text">solicite agora<span>.</span>

							</fieldset>
						</div>
						<div class="mp-container">
							<!-- Rounded switch -->
							<div>

								<legend class="mp-settings-switch">
									<input type="checkbox">
									<span class="mp-settings-slider mp-settings-round"></span>
								</legend>
							</div>
							<div class="mp-settings-margin-left">
								<p class="mp-settings-subtitle-font-size mp-settings-debug">
									Modo debug e log
								</p>
								<p class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color mp-settings-debug">
									Gravamos ações da sua loja para proporcionar melhor suporte.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr class="mp-settings-hr" />
	<div class="mp-settings-payment">
		<div class="mp-settings-badge-spacing">
			<div class="mp-settings-badge-align">
				<div class="mp-settings-align-div">
					<div><span class="mp-settings-font-color mp-settings-title-blocks mp-settings-margin-right">3. Configure os meios de pagamento</span></div>

					<img class="mp-icon mp-settings-margin-left mp-settings-margin-right" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">
				</div>
			</div>

			<div class="mp-settings-margin-left">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-open.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>
		<div class="mp-settings-block-align-top">
		<p class="mp-settings-subtitle-font-size">Selecione um meio de pagamento a seguir para ver mais opções</p>
		<div class="mp-block mp-block-flex mp-settings-payment-block mp-settings-margin-right">
			<div class="mp-settings-align-div mp-block-flex">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-mp.png', plugin_dir_path(__FILE__))); ?>">
				<span class="mp-settings-subtitle-font-size mp-settings-margin-title-payment"><b>Checkout Pro</b> - Pix, débito, crédito e boleto, no ambiente do Mercado Pago</span>
				<span class="mp-settings-badge-active">Ativado</span>
			</div>
			<div class="mp-settings-align-div">
				<span class="mp-settings-text-payment">Configurar</span>
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-config.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>

		<div class="mp-block mp-block-flex mp-settings-payment-block mp-settings-margin-right">
			<div class="mp-settings-align-div mp-block-flex">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-card.png', plugin_dir_path(__FILE__))); ?>">
				<span class="mp-settings-subtitle-font-size mp-settings-margin-title-payment"><b>Débito e crédito</b> - Checkout Transparente, no ambiente da sua loja</span>
				<span class="mp-settings-badge-active">Ativado</span>
			</div>
			<div class="mp-settings-align-div">
				<span class="mp-settings-text-payment">Configurar</span>
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-config.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>
		<div class="mp-block mp-block-flex mp-settings-payment-block mp-settings-margin-right">
			<div class="mp-settings-align-div mp-block-flex">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-code.png', plugin_dir_path(__FILE__))); ?>">
				<span class="mp-settings-subtitle-font-size mp-settings-margin-title-payment"><b>Boleto e lotérica</b> - Checkout Transparente, no ambiente da sua loja</span>
				<span class="mp-settings-badge-inactive">Inativo</span>
			</div>
			<div class="mp-settings-align-div">
				<span class="mp-settings-text-payment">Configurar</span>
				<img class="" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-config.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>
		<div class="mp-block mp-block-flex mp-settings-payment-block mp-settings-margin-right mp-settings-border-bottom-payment">
			<div class="mp-settings-align-div mp-block-flex">
				<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-pix.png', plugin_dir_path(__FILE__))); ?>">
				<span class="mp-settings-subtitle-font-size mp-settings-margin-title-payment"><b>Pix</b> - Checkout Transparente, no ambiente da sua loja</span>
				<span class="mp-settings-badge-inactive">Inativo</span>
			</div>
			<div class="mp-settings-align-div">
				<span class="mp-settings-text-payment">Configurar</span>
				<img class="" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-config.png', plugin_dir_path(__FILE__))); ?>">
			</div>
		</div>
		</div>
		<button class="mp-button"> Continuar </button>
	</div>
	<hr class="mp-settings-hr" />
	<div class="mp-settings-mode">
		<div class="mp-settings-badge-spacing"">
			<div class=" mp-settings-badge-align">
			<div class="mp-settings-align-div">
				<div><span class="mp-settings-font-color mp-settings-title-blocks mp-settings-margin-right">4. Teste sua loja antes de vender</span></div>
			</div>

			<div>
				<div class="mp-settings-test-mode-alert mp-settings-margin-left mp-settings-margin-right"><span>Loja em modo teste</span></div>
			</div>
		</div>

		<div class="mp-settings-margin-left">
			<img src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-open.png', plugin_dir_path(__FILE__))); ?>">
		</div>
	</div>
	<div class="mp-settings-block-align-top ">
	<p class="mp-settings-subtitle-font-size mp-settings-title-color">Teste a experiência no Modo Teste. Depois ative o Modo Vendas (Produção) para fazer vendas.</p>

	<div class="mp-container">
		<div class="mp-block" style="flex-direction:column; justify-content:space-between">
			<div>
				<p class="mp-settings-title-font-size"><b>Escolha como você quer operar sua loja:</b></p>
			</div>
			<div class="mp-settings-mode-container">
				<div class="mp-settings-mode-spacing">
					<input type="radio" class="mp-settings-radio-button">
				</div>
				<div>
					<span class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-font-color">Modo Teste</span><br>

					<span class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color">Checkouts Mercado Pago inativos para cobranças reais.<span class="mp-settings-blue-text"> Regras do modo teste.<span></span>
				</div>
			</div>
			<div class="mp-settings-mode-container">
				<div class="mp-settings-mode-spacing">
					<input type="radio" class="mp-settings-radio-button">
				</div>
				<div>
					<span class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-font-color">Modo Vendas (Produção)</span><br>

					<span class="mp-settings-font-color mp-settings-subtitle-font-size mp-settings-title-color">Mercado Pago ativos para cobranças reais.</span>
				</div>
			</div>
			<div class="mp-settings-alert-payment-methods">

				<div class="mp-settings-alert-payment-methods-orange"></div>
				<div class=" mp-settings-alert-payment-methods-gray">

					<div style="width: 16px; height:16px; background:rgba(0, 0, 0, 0.04);" class="mp-settings-margin-right">
						<img class="mp-icon" src="<?php echo esc_url(plugins_url('../assets/images/mercadopago-settings/icon-info.png', plugin_dir_path(__FILE__))); ?>">

					</div>
					<div style="display:flex; flex-direction:column; justify-content:flex-start;">
						<div class="mp-settings-margin-left">
							<div class="mp-settings-alert-mode-title">
								<span>Meios de pagamento Mercado Pago em Modo Teste </span>
							</div>
							<div class="mp-settings-alert-mode-body">
								<span class="mp-settings-blue-text">Visite sua loja</span> para testar compras
							</div>
						</div>

					</div>
				</div>


			</div>
		</div>
		</div>
	</div>
	<button class="mp-button"> Salvar Mudanças </button>

</div>

</div>
