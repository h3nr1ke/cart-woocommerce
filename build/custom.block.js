(()=>{"use strict";const e=window.React,t=window.wp.element,a=window.wc.wcBlocksRegistry,c=window.wp.htmlEntities,n=window.wc.wcSettings,s="mercadopago_blocks_update_cart",o=({title:t,description:a,linkText:c,linkSrc:n})=>(0,e.createElement)("div",{className:"mp-checkout-pro-test-mode"},(0,e.createElement)("test-mode",{title:t,description:a,"link-text":c,"link-src":n})),m=({isOptinal:t,message:a,forId:c})=>(0,e.createElement)("input-label",{isOptinal:t,message:a,for:c}),l=({isVisible:t,message:a,inputId:c,id:n,dataMain:s})=>(0,e.createElement)("input-helper",{isVisible:t,message:a,"input-id":c,id:n,"data-main":s}),i=({labelMessage:t,helperMessage:a,inputName:c,hiddenId:n,inputDataCheckout:s,selectId:o,selectName:m,selectDataCheckout:l,flagError:i,documents:r,validate:d})=>(0,e.createElement)("div",{className:"mp-checkout-ticket-input-document"},(0,e.createElement)("input-document",{"label-message":t,"helper-message":a,"input-name":c,"hidden-id":n,"input-data-checkout":s,"select-id":o,"select-name":m,"select-data-checkout":l,"flag-error":i,documents:r,validate:d})),r=({methods:t})=>(0,e.createElement)("payment-methods",{methods:t}),d=({description:t,linkText:a,linkSrc:c,checkoutClass:n="pro"})=>(0,e.createElement)("div",{className:`mp-checkout-${n}-terms-and-conditions`},(0,e.createElement)("terms-and-conditions",{description:t,"link-text":a,"link-src":c}));var p;const u="woo-mercado-pago-custom",_=(0,n.getSetting)("woo-mercado-pago-custom_data",{}),h=(0,c.decodeEntities)(_.title)||"Checkout Custom",k=a=>{(e=>{const{extensionCartUpdate:a}=wc.blocksCheckout,{eventRegistration:c,emitResponse:n}=e,{onPaymentSetup:o}=c;(0,t.useEffect)((()=>{((e,t)=>{e({namespace:s,data:{action:"add",gateway:t}})})(a,u);const e=o((()=>({type:n.responseTypes.SUCCESS})));return()=>{((e,t)=>{e({namespace:s,data:{action:"remove",gateway:t}})})(a,u),e()}}),[o])})(a);const{test_mode:c,test_mode_title:n,test_mode_description:p,test_mode_link_text:h,test_mode_link_src:k,wallet_button:E,wallet_button_image:y,wallet_button_title:v,wallet_button_description:b,wallet_button_button_text:g,available_payments_title_icon:w,available_payments_title:f,available_payments_image:x,payment_methods_items:C,payment_methods_promotion_link:S,payment_methods_promotion_text:I,site_id:N,card_form_title:T,card_number_input_label:M,card_number_input_helper:R,card_holder_name_input_label:F,card_holder_name_input_helper:P,card_expiration_input_label:D,card_expiration_input_helper:O,card_security_code_input_label:V,card_security_code_input_helper:U,card_document_input_label:L,card_document_input_helper:B,card_installments_title:q,card_issuer_input_label:H,card_installments_input_helper:$,terms_and_conditions_description:j,terms_and_conditions_link_text:A,terms_and_conditions_link_src:Y,amount:z,currency_ratio:Q}=_.params,G=(0,t.useRef)(null),[J,K]=(0,t.useState)("custom"),{eventRegistration:W,emitResponse:X,onSubmit:Z}=a,{onPaymentSetup:ee,onCheckoutSuccess:te}=W;return window.mpFormId="blocks_checkout_form",window.mpCheckoutForm=document.querySelector(".wc-block-components-form.wc-block-checkout__form"),jQuery(window.mpCheckoutForm).prop("id",mpFormId),(0,t.useEffect)((()=>{cardFormMounted&&cardForm.unmount(),initCardForm();const e=ee((async()=>{if("wallet_button"!==document.querySelector("#mp_checkout_type").value)try{if(!CheckoutPage.validateInputsCreateToken())return{type:X.responseTypes.ERROR};{const e=await cardForm.createCardToken();document.querySelector("#cardTokenId").value=e.token}}catch(e){console.warn("Token creation error: ",e)}const e=G.current,t={};return e.childNodes.forEach((e=>{"INPUT"===e.tagName&&e.name&&(t[e.name]=e.value)})),K("custom"),{type:X.responseTypes.SUCCESS,meta:{paymentMethodData:t}}}));return()=>e()}),[ee,X.responseTypes.ERROR,X.responseTypes.SUCCESS]),(0,t.useEffect)((()=>{const e=te((async e=>{const t=e.processingResponse.paymentDetails;if(t.three_ds_flow){const e=new Promise(((e,t)=>{window.addEventListener("completed_3ds",(a=>{a.detail.error&&(console.log("rejecting with "+a.detail.error),t(a.detail.error)),e()}))}));return load3DSFlow(t.last_four_digits),await e.then((()=>({type:X.responseTypes.SUCCESS}))).catch((e=>({type:X.responseTypes.FAIL,message:e})))}return{type:X.responseTypes.SUCCESS}}));return()=>e()}),[te]),(0,e.createElement)("div",null,(0,e.createElement)("div",{class:"mp-checkout-custom-load"},(0,e.createElement)("div",{class:"spinner-card-form"})),(0,e.createElement)("div",{class:"mp-checkout-container"},(0,e.createElement)("div",{class:"mp-checkout-custom-container"},c?(0,e.createElement)("div",{class:"mp-checkout-pro-test-mode"},(0,e.createElement)(o,{title:n,description:p,linkText:h,linkSrc:k})):null,"yes"===E?(0,e.createElement)("div",{class:"mp-wallet-button-container"},(0,e.createElement)("img",{src:y}),(0,e.createElement)("div",{class:"mp-wallet-button-title"},(0,e.createElement)("span",null,v)),(0,e.createElement)("div",{class:"mp-wallet-button-description"},b),(0,e.createElement)("div",{class:"mp-wallet-button-button"},(0,e.createElement)("button",{id:"mp-wallet-button",type:"button",onClick:e=>{e.preventDefault(),K("wallet_button"),Z()}},g))):null,(0,e.createElement)("div",{id:"mp-custom-checkout-form-container"},(0,e.createElement)("div",{class:"mp-checkout-custom-available-payments"},(0,e.createElement)("div",{class:"mp-checkout-custom-available-payments-header",onClick:()=>{const e=document.getElementsByClassName("mp-checkout-custom-available-payments")[0],t=e.getElementsByClassName("mp-checkout-custom-available-payments-header")[0].getElementsByClassName("mp-checkout-custom-available-payments-collapsible")[0],a=e.getElementsByClassName("mp-checkout-custom-available-payments-content")[0];if(a.style.maxHeight)t.src=_.params.available_payments_chevron_down,a.style.maxHeight=null,a.style.padding="0px";else{let e=a.scrollHeight+15+"px";t.src=_.params.available_payments_chevron_up,a.style.setProperty("max-height",e,"important"),a.style.setProperty("padding","24px 0px 0px","important")}}},(0,e.createElement)("div",{class:"mp-checkout-custom-available-payments-title"},(0,e.createElement)("img",{src:w,class:"mp-icon"}),(0,e.createElement)("p",{class:"mp-checkout-custom-available-payments-text"},f)),(0,e.createElement)("img",{src:x,class:"mp-checkout-custom-available-payments-collapsible"})),(0,e.createElement)("div",{class:"mp-checkout-custom-available-payments-content"},(0,e.createElement)(r,{methods:C}),"MLA"===N?(0,e.createElement)(e.Fragment,null,(0,e.createElement)("span",{id:"mp_promotion_link"}," | "),(0,e.createElement)("a",{href:S,id:"mp_checkout_link",class:"mp-checkout-link mp-pl-10",target:"_blank"},I)):null,(0,e.createElement)("hr",null))),(0,e.createElement)("div",{class:"mp-checkout-custom-card-form"},(0,e.createElement)("p",{class:"mp-checkout-custom-card-form-title"},T),(0,e.createElement)("div",{class:"mp-checkout-custom-card-row"},(0,e.createElement)(m,{isOptinal:!1,message:M,forId:"mp-card-number"}),(0,e.createElement)("div",{class:"mp-checkout-custom-card-input",id:"form-checkout__cardNumber-container"}),(0,e.createElement)(l,{isVisible:!1,message:R,inputId:"mp-card-number-helper"})),(0,e.createElement)("div",{class:"mp-checkout-custom-card-row",id:"mp-card-holder-div"},(0,e.createElement)(m,{message:F,isOptinal:!1}),(0,e.createElement)("input",{class:"mp-checkout-custom-card-input mp-card-holder-name",placeholder:"Ex.: María López",id:"form-checkout__cardholderName",name:"mp-card-holder-name","data-checkout":"cardholderName"}),(0,e.createElement)(l,{isVisible:!1,message:P,inputId:"mp-card-holder-name-helper",dataMain:"mp-card-holder-name"})),(0,e.createElement)("div",{class:"mp-checkout-custom-card-row mp-checkout-custom-dual-column-row"},(0,e.createElement)("div",{class:"mp-checkout-custom-card-column"},(0,e.createElement)(m,{message:D,isOptinal:!1}),(0,e.createElement)("div",{id:"form-checkout__expirationDate-container",class:"mp-checkout-custom-card-input mp-checkout-custom-left-card-input"}),(0,e.createElement)(l,{isVisible:!1,message:O,inputId:"mp-expiration-date-helper"})),(0,e.createElement)("div",{class:"mp-checkout-custom-card-column"},(0,e.createElement)(m,{message:V,isOptinal:!1}),(0,e.createElement)("div",{id:"form-checkout__securityCode-container",class:"mp-checkout-custom-card-input"}),(0,e.createElement)("p",{id:"mp-security-code-info",class:"mp-checkout-custom-info-text"}),(0,e.createElement)(l,{isVisible:!1,message:U,inputId:"mp-security-code-helper"}))),(0,e.createElement)("div",{id:"mp-doc-div",class:"mp-checkout-custom-input-document",style:{display:"none"}},(0,e.createElement)(i,{labelMessage:L,helperMessage:B,inputName:"identificationNumber",hiddenId:"form-checkout__identificationNumber",inputDataCheckout:"docNumber",selectId:"form-checkout__identificationType",selectName:"identificationType",selectDataCheckout:"docType",flagError:"docNumberError"}))),(0,e.createElement)("div",{id:"mp-checkout-custom-installments",class:"mp-checkout-custom-installments-display-none"},(0,e.createElement)("p",{class:"mp-checkout-custom-card-form-title"},q),(0,e.createElement)("div",{id:"mp-checkout-custom-issuers-container",class:"mp-checkout-custom-issuers-container"},(0,e.createElement)("div",{class:"mp-checkout-custom-card-row"},(0,e.createElement)(m,{isOptinal:!1,message:H,forId:"mp-issuer"})),(0,e.createElement)("div",{class:"mp-input-select-input"},(0,e.createElement)("select",{name:"issuer",id:"form-checkout__issuer",class:"mp-input-select-select"}))),(0,e.createElement)("div",{id:"mp-checkout-custom-installments-container",class:"mp-checkout-custom-installments-container"}),(0,e.createElement)(l,{isVisible:!1,message:$,inputId:"mp-installments-helper"}),(0,e.createElement)("select",{style:{display:"none"},"data-checkout":"installments",name:"installments",id:"form-checkout__installments",class:"mp-input-select-select"}),(0,e.createElement)("div",{id:"mp-checkout-custom-box-input-tax-cft"},(0,e.createElement)("div",{id:"mp-checkout-custom-box-input-tax-tea"},(0,e.createElement)("div",{id:"mp-checkout-custom-tax-tea-text"})),(0,e.createElement)("div",{id:"mp-checkout-custom-tax-cft-text"}))),(0,e.createElement)("div",{class:"mp-checkout-custom-terms-and-conditions"},(0,e.createElement)(d,{description:j,linkText:A,linkSrc:Y,checkoutClass:"custom"}))))),(0,e.createElement)("div",{ref:G,id:"mercadopago-utilities",style:{display:"none"}},(0,e.createElement)("input",{type:"hidden",id:"cardTokenId",name:"mercadopago_custom[token]"}),(0,e.createElement)("input",{type:"hidden",id:"mpCardSessionId",name:"mercadopago_custom[session_id]"}),(0,e.createElement)("input",{type:"hidden",id:"cardExpirationYear","data-checkout":"cardExpirationYear"}),(0,e.createElement)("input",{type:"hidden",id:"cardExpirationMonth","data-checkout":"cardExpirationMonth"}),(0,e.createElement)("input",{type:"hidden",id:"cardInstallments",name:"mercadopago_custom[installments]"}),(0,e.createElement)("input",{type:"hidden",id:"paymentMethodId",name:"mercadopago_custom[payment_method_id]"}),(0,e.createElement)("input",{type:"hidden",id:"mp-amount",defaultValue:z,name:"mercadopago_custom[amount]"}),(0,e.createElement)("input",{type:"hidden",id:"currency_ratio",defaultValue:Q,name:"mercadopago_custom[currency_ratio]"}),(0,e.createElement)("input",{type:"hidden",id:"mp_checkout_type",name:"mercadopago_custom[checkout_type]",value:J})))},E={name:u,label:(0,e.createElement)((t=>{const{PaymentMethodLabel:a}=t.components,n=(0,c.decodeEntities)(_?.params?.fee_title||""),s=`${h} ${n}`;return(0,e.createElement)(a,{text:s})}),null),content:(0,e.createElement)(k,null),edit:(0,e.createElement)(k,null),canMakePayment:()=>!0,ariaLabel:h,supports:{features:null!==(p=_?.supports)&&void 0!==p?p:[]}};(0,a.registerPaymentMethod)(E)})();