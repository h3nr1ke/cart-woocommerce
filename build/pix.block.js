(()=>{"use strict";var e={989:(e,t,n)=>{n.d(t,{Z:()=>r});var i=n(196);const r=({title:e,subtitle:t,alt:n,linkSrc:r})=>(0,i.createElement)("pix-template",{title:e,subtitle:t,alt:n,src:r})},191:(e,t,n)=>{n.d(t,{Z:()=>r});var i=n(196);const r=({description:e,linkText:t,linkSrc:n})=>(0,i.createElement)("div",{className:"mp-checkout-pro-terms-and-conditions"},(0,i.createElement)("terms-and-conditions",{description:e,"link-text":t,"link-src":n}))},512:(e,t,n)=>{n.d(t,{Z:()=>r});var i=n(196);const r=({title:e,description:t,linkText:n,linkSrc:r})=>(0,i.createElement)("div",{className:"mp-checkout-pro-test-mode"},(0,i.createElement)("test-mode",{title:e,description:t,"link-text":n,"link-src":r}))},196:e=>{e.exports=window.React}},t={};function n(i){var r=t[i];if(void 0!==r)return r.exports;var c=t[i]={exports:{}};return e[i](c,c.exports,n),c.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var i in t)n.o(t,i)&&!n.o(e,i)&&Object.defineProperty(e,i,{enumerable:!0,get:t[i]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e=n(196);const t=window.wc.wcBlocksRegistry,i=window.wc.wcSettings,r=window.wp.htmlEntities;var c,o=n(989),a=n(191),l=n(512);const s=wc_mercadopago_pix_blocks_params,d=(0,i.getSetting)("woo-mercado-pago-pix_data",{}),m=(0,r.decodeEntities)(d.title)||"Checkout Pix",p=()=>{const{test_mode_title:t,test_mode_description:n,pix_template_title:i,pix_template_subtitle:r,pix_template_src:c,pix_template_alt:d,terms_and_conditions_description:m,terms_and_conditions_link_text:p,terms_and_conditions_link_src:_,test_mode:u}=s;return(0,e.createElement)("div",{className:"mp-checkout-container"},(0,e.createElement)("div",{className:"mp-checkout-pix-container"},(0,e.createElement)("div",{className:"mp-checkout-pix-content"},u?(0,e.createElement)(l.Z,{title:t,description:n}):null,(0,e.createElement)(o.Z,{title:i,subTitle:r,alt:d,linkSrc:c}))),(0,e.createElement)(a.Z,{description:m,linkText:p,linkSrc:_}))},_={name:"woo-mercado-pago-pix",label:(0,e.createElement)((t=>{const{PaymentMethodLabel:n}=t.components;return(0,e.createElement)(n,{text:m})}),null),content:(0,e.createElement)(p,null),edit:(0,e.createElement)(p,null),canMakePayment:()=>!0,ariaLabel:m,supports:{features:null!==(c=d?.supports)&&void 0!==c?c:[]}};(0,t.registerPaymentMethod)(_)})()})();