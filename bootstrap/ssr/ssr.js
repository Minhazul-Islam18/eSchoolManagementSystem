import { unref, withCtx, createVNode, useSSRContext, reactive, createTextVNode, computed, watch, mergeProps, createSSRApp, h } from "vue";
import { ssrRenderComponent, ssrRenderStyle, ssrRenderList, ssrInterpolate, ssrIncludeBooleanAttr, ssrRenderAttr, ssrRenderAttrs, ssrRenderSlot } from "vue/server-renderer";
import { Head, usePage, Link, createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { renderToString } from "@vue/server-renderer";
import "@flasher/flasher";
import { XCircle } from "lucide-vue-next";
const _sfc_main$5 = {
  __name: "Contact",
  __ssrInlineRender: true,
  props: {
    "pricings": Array,
    "school": Array | Object,
    "message": String
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), null, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<title${_scopeId}>Contact - RCT ems</title><meta name="keywords" content="RCT Seba, RCT ems, ems, lms"${_scopeId}><link rel="preconnect" href="https://fonts.googleapis.com"${_scopeId}><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin${_scopeId}><link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&amp;display=swap" rel="stylesheet"${_scopeId}>`);
          } else {
            return [
              createVNode("title", null, "Contact - RCT ems"),
              createVNode("meta", {
                name: "keywords",
                content: "RCT Seba, RCT ems, ems, lms"
              }),
              createVNode("link", {
                rel: "preconnect",
                href: "https://fonts.googleapis.com"
              }),
              createVNode("link", {
                rel: "preconnect",
                href: "https://fonts.gstatic.com",
                crossorigin: ""
              }),
              createVNode("link", {
                href: "https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap",
                rel: "stylesheet"
              })
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<section class="min-h-screen bg-gradient-to-tr from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]" style="${ssrRenderStyle({ "font-family": "'Jost', sans-serif" })}"><div class="container py-12 mx-auto"><h2 class="text-3xl uppercase mb-4 pb-2 border-b border-emerald-500 font-extrabold">Contact us</h2><div class="flex flex-wrap w-full flex-col gap-2"><div class="flex flex-col gap-1 w-full"><label for="" class="form-label">Full name</label><input type="text" name="" class="form-input rounded" placeholder="Your Full name" id=""></div><div class="flex flex-col gap-1 w-full"><label for="" class="form-label">E-mail</label><input type="email" name="" class="form-input rounded" placeholder="Your E-mail address" id=""></div><div class="flex flex-col gap-1 w-full"><label for="" class="form-label">Phone number</label><input type="tel" name="" class="form-input rounded" placeholder="Your Phone number" id=""></div><div class="flex flex-col gap-1 w-full"><label for="" class="form-label">Message</label><textarea name="" class="form-input rounded" id="" cols="30" rows="10" placeholder="Write your message here"></textarea></div><div><button type="submit" class="border border-slate-900 after:content-[&#39;&#39;] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3">Submit</button></div></div></div></section><!--]-->`);
    };
  }
};
const _sfc_setup$5 = _sfc_main$5.setup;
_sfc_main$5.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Contact.vue");
  return _sfc_setup$5 ? _sfc_setup$5(props, ctx) : void 0;
};
const __vite_glob_0_0 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$5
}, Symbol.toStringTag, { value: "Module" }));
const _sfc_main$4 = {
  __name: "Home",
  __ssrInlineRender: true,
  props: {
    pricings: Array | Object,
    school: Array | Object,
    package_purchased: String,
    message: String
  },
  setup(__props) {
    usePage();
    const form = reactive({
      amount: null,
      id: null
    });
    reactive({
      id: null
    });
    const props = __props;
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), null, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<title${_scopeId}>Home - RCT ems</title><meta name="keywords" content="RCT Seba, RCT ems, ems, lms"${_scopeId}><link rel="preconnect" href="https://fonts.googleapis.com"${_scopeId}><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin${_scopeId}><link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&amp;display=swap" rel="stylesheet"${_scopeId}>`);
          } else {
            return [
              createVNode("title", null, "Home - RCT ems"),
              createVNode("meta", {
                name: "keywords",
                content: "RCT Seba, RCT ems, ems, lms"
              }),
              createVNode("link", {
                rel: "preconnect",
                href: "https://fonts.googleapis.com"
              }),
              createVNode("link", {
                rel: "preconnect",
                href: "https://fonts.gstatic.com",
                crossorigin: ""
              }),
              createVNode("link", {
                href: "https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap",
                rel: "stylesheet"
              })
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<section id="hero-top" class="h-screen py-6 md:py-0 md:bg-gradient-to-t from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc] bg-[url(&#39;/public/frontend/hero_1.png&#39;)] bg-no-repeat bg-contain bg-bottom"><div class="flex flex-wrap flex-col sm:flex-row container h-full mx-auto"><div class="w-full md:w-5/12 flex flex-col justify-center items-start"><h1 class="font-extrabold text-3xl md:text-5xl leading-12 text-emerald-500">শিক্ষা ব্যবস্থাপনা সফটওয়্যার </h1><h5 class="font-semibold text-lg md:text-2xl before:block before:absolute before:-inset-1 -skew-y-3 md:transform-none before:bg-pink-500 md:before:bg-transparent my-4 md:my-1 relative inline-block z-10"><span class="relative text-white md:text-slate-900" style="${ssrRenderStyle({ "font-family": "'Jost', sans-serif" })}">Education management system</span></h5><p class="mt-4 mb-3 text-md antialiased">আরসিটিসেবা আপনার প্রতিষ্ঠানের কাজগুলো সহজে, ডিজিটাল উপায়ে ও ঝামেলাহীনভাবে শিক্ষক-শিক্ষার্থী ও অভিভাবকদের মধ্যে সমন্বয় করে.</p><p class="mt-2 mb-3 sm:mb-6 text-md antialiased"> আপনার শিক্ষা প্রতিষ্ঠানকে ডিজিটাল ও স্মার্ট করুন আরসিটি এম এস-এর মাধ্যমে </p>`);
      _push(ssrRenderComponent(unref(Link), {
        href: "/",
        type: "button",
        class: "border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3",
        style: { "font-family": "'Jost', sans-serif" }
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` Register`);
          } else {
            return [
              createTextVNode(" Register")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</div><div style="${ssrRenderStyle({ backgroundImage: `url('/frontend/hero_1.png')` })}" class="w-full hidden md:block md:w-7/12 md:bg-contain lg:bg-contain xl:bg-cover bg-no-repeat bg-center"></div></div></section><section id="pricing-plan" class="py-10 bg-gradient-to-b from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]" style="${ssrRenderStyle({ "font-family": "'Jost', sans-serif" })}"><div class="container mx-auto"><div class="relative z-10 overflow-hidden rounded-sm border border-stroke bg-white p-11 shadow-default dark:border-strokedark dark:bg-boxdark"><div class="w-full overflow-x-auto">`);
      if (props.pricings.length > 0) {
        _push(`<table class="table-auto w-full"><thead><tr><th class="w-1/4 min-w-[200px] px-5"></th><!--[-->`);
        ssrRenderList(props.pricings, (pricing) => {
          _push(`<th class="w-1/4 min-w-[200px] px-5"><form><div class="mb-10 text-left"><span class="mb-3.5 block text-xl font-bold text-black dark:text-white">${ssrInterpolate(pricing.name)}</span><h4 class="mb-4"><span class="text-[28px] font-bold text-black dark:text-white lg:text-[32px]"><sup class="font-xs">৳</sup> ${ssrInterpolate(pricing.price ?? 0)}</span><sub class="font-xs">/ Month</sub></h4><p class="mb-6 text-base font-medium">${ssrInterpolate(pricing.additional_features)}</p><button style="${ssrRenderStyle(props.school !== null && props.school.package_id == null ? null : { display: "none" })}"${ssrIncludeBooleanAttr(form.processing) ? " disabled" : ""} class="block w-full rounded-md bg-primary p-3 text-center font-medium text-white transition hover:bg-opacity-90" type="submit">${ssrInterpolate(pricing.price > 0 ? "Purchase Now" : "Free")}</button></div></form></th>`);
        });
        _push(`<!--]--></tr></thead><tbody><tr><td class="border-t border-r border-stroke py-5 px-7 dark:border-strokedark border-l"><h5 class="font-medium text-black dark:text-white">Key Features</h5></td><!--[-->`);
        ssrRenderList(props.pricings, (pricing) => {
          _push(`<td class="border-t border-r border-stroke py-5 px-7 dark:border-strokedark"><h5 class="font-medium text-black dark:text-white text-center">Key Features</h5></td>`);
        });
        _push(`<!--]--></tr><tr><td class="border-l border-t border-r border-b border-stroke py-5 px-7 dark:border-strokedark"><p class="font-medium">Allowed students</p></td><!--[-->`);
        ssrRenderList(props.pricings, (pricing) => {
          _push(`<td class="border-t border-l border-stroke py-5 px-7 dark:border-strokedark border-b border-r"><p class="text-center font-medium">${ssrInterpolate(pricing.allowed_students)}</p></td>`);
        });
        _push(`<!--]--></tr></tbody></table>`);
      } else {
        _push(`<h1 class="text-xl text-center font-extrabold">${ssrInterpolate("Sorry, No plans found!")}</h1>`);
      }
      _push(`</div><div class="absolute top-0 left-0 -z-1"><span class="absolute top-0 left-0 -z-1"><svg width="213" height="188" viewBox="0 0 213 188" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="75" cy="50" r="138" fill="url(#paint0_linear)"></circle><defs><linearGradient id="paint0_linear" x1="75" y1="-88" x2="75" y2="188" gradientUnits="userSpaceOnUse"><stop stop-color="#3056D3" stop-opacity="0.15"></stop><stop offset="1" stop-color="#C4C4C4" stop-opacity="0"></stop></linearGradient></defs></svg></span><span class="absolute top-30 left-11 -z-1"><svg width="50" height="109" viewBox="0 0 50 109" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="47.71" cy="107.259" r="1.74121" transform="rotate(180 47.71 107.259)" fill="#3056D3"></circle><circle cx="47.71" cy="91.9355" r="1.74121" transform="rotate(180 47.71 91.9355)" fill="#3056D3"></circle><circle cx="47.71" cy="76.6133" r="1.74121" transform="rotate(180 47.71 76.6133)" fill="#3056D3"></circle><circle cx="47.71" cy="47.0132" r="1.74121" transform="rotate(180 47.71 47.0132)" fill="#3056D3"></circle><circle cx="47.71" cy="16.7158" r="1.74121" transform="rotate(180 47.71 16.7158)" fill="#3056D3"></circle><circle cx="47.71" cy="61.6392" r="1.74121" transform="rotate(180 47.71 61.6392)" fill="#3056D3"></circle><circle cx="47.71" cy="32.0386" r="1.74121" transform="rotate(180 47.71 32.0386)" fill="#3056D3"></circle><circle cx="47.71" cy="1.74121" r="1.74121" transform="rotate(180 47.71 1.74121)" fill="#3056D3"></circle><circle cx="32.3877" cy="107.259" r="1.74121" transform="rotate(180 32.3877 107.259)" fill="#3056D3"></circle><circle cx="32.3877" cy="91.9355" r="1.74121" transform="rotate(180 32.3877 91.9355)" fill="#3056D3"></circle><circle cx="32.3877" cy="76.6133" r="1.74121" transform="rotate(180 32.3877 76.6133)" fill="#3056D3"></circle><circle cx="32.3877" cy="47.0132" r="1.74121" transform="rotate(180 32.3877 47.0132)" fill="#3056D3"></circle><circle cx="32.3877" cy="16.7158" r="1.74121" transform="rotate(180 32.3877 16.7158)" fill="#3056D3"></circle><circle cx="32.3877" cy="61.6392" r="1.74121" transform="rotate(180 32.3877 61.6392)" fill="#3056D3"></circle><circle cx="32.3877" cy="32.0386" r="1.74121" transform="rotate(180 32.3877 32.0386)" fill="#3056D3"></circle><circle cx="32.3877" cy="1.74121" r="1.74121" transform="rotate(180 32.3877 1.74121)" fill="#3056D3"></circle><circle cx="17.0654" cy="107.259" r="1.74121" transform="rotate(180 17.0654 107.259)" fill="#3056D3"></circle><circle cx="17.0654" cy="91.9355" r="1.74121" transform="rotate(180 17.0654 91.9355)" fill="#3056D3"></circle><circle cx="17.0654" cy="76.6133" r="1.74121" transform="rotate(180 17.0654 76.6133)" fill="#3056D3"></circle><circle cx="17.0654" cy="47.0132" r="1.74121" transform="rotate(180 17.0654 47.0132)" fill="#3056D3"></circle><circle cx="17.0654" cy="16.7158" r="1.74121" transform="rotate(180 17.0654 16.7158)" fill="#3056D3"></circle><circle cx="17.0654" cy="61.6392" r="1.74121" transform="rotate(180 17.0654 61.6392)" fill="#3056D3"></circle><circle cx="17.0654" cy="32.0386" r="1.74121" transform="rotate(180 17.0654 32.0386)" fill="#3056D3"></circle><circle cx="17.0654" cy="1.74121" r="1.74121" transform="rotate(180 17.0654 1.74121)" fill="#3056D3"></circle><circle cx="1.74121" cy="107.259" r="1.74121" transform="rotate(180 1.74121 107.259)" fill="#3056D3"></circle><circle cx="1.74121" cy="91.9355" r="1.74121" transform="rotate(180 1.74121 91.9355)" fill="#3056D3"></circle><circle cx="1.74121" cy="76.6133" r="1.74121" transform="rotate(180 1.74121 76.6133)" fill="#3056D3"></circle><circle cx="1.74121" cy="47.0132" r="1.74121" transform="rotate(180 1.74121 47.0132)" fill="#3056D3"></circle><circle cx="1.74121" cy="16.7158" r="1.74121" transform="rotate(180 1.74121 16.7158)" fill="#3056D3"></circle><circle cx="1.74121" cy="61.6392" r="1.74121" transform="rotate(180 1.74121 61.6392)" fill="#3056D3"></circle><circle cx="1.74121" cy="32.0386" r="1.74121" transform="rotate(180 1.74121 32.0386)" fill="#3056D3"></circle><circle cx="1.74121" cy="1.74121" r="1.74121" transform="rotate(180 1.74121 1.74121)" fill="#3056D3"></circle></svg></span></div></div></div></section><!--]-->`);
    };
  }
};
const _sfc_setup$4 = _sfc_main$4.setup;
_sfc_main$4.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Home.vue");
  return _sfc_setup$4 ? _sfc_setup$4(props, ctx) : void 0;
};
const __vite_glob_0_1 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$4
}, Symbol.toStringTag, { value: "Module" }));
const __default__ = {
  data() {
    return {
      scripts: [
        "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js",
        this.bkashSandbox ? "https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js" : "https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"
        // Add more script URLs as needed
      ],
      bkashSandbox: true
      // Set to your condition
    };
  },
  mounted() {
    const jquery = document.createElement("script");
    jquery.setAttribute(
      "src",
      "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    );
    document.head.appendChild(jquery);
    const bKash = document.createElement("script");
    bKash.setAttribute(
      "src",
      "https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"
    );
    document.head.appendChild(bKash);
    console.log("oh");
  }
};
const _sfc_main$3 = /* @__PURE__ */ Object.assign(__default__, {
  __name: "Payment",
  __ssrInlineRender: true,
  props: {
    logo: String,
    bkashScript: String
  },
  setup(__props) {
    const page = usePage();
    computed(() => page.props.bkashSandox);
    const props = __props;
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[--><div class="grid h-screen place-items-center"><img${ssrRenderAttr("src", `/storage/${props.logo}`)} width="120px" alt=""><button onclick="BkashPayment()" class="px-6 py-2 from-pink-600 bg-gradient-to-t to-pink-500 flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" height="auto" width="30" viewBox="-6.6741 -11.07275 57.8422 66.4365"><g fill="none"><path fill="#DF146E" d="M42.31 44.291H2.182C.981 44.291 0 43.308 0 42.107V2.186C0 .982.981 0 2.182 0H42.31c1.203 0 2.184.982 2.184 2.186v39.921c0 1.201-.981 2.184-2.184 2.184"></path><path fill="#FFF" d="M31.894 24.251l-14.107-2.246 1.909 8.329zm.572-.682L21.374 8.16l-3.623 13.106zm-15.402-2.482L5.441 6.239l15.221 1.819zm-5.639-6.154l-6.449-6.08h1.695zm24.504 1.15L33.2 23.486l-4.426-6.118zM21.417 30.232l10.71-4.3.454-1.365zm-8.933 7.821l4.589-16.102 2.326 10.479zm24.099-21.914l-1.128 3.056 4.059-.07z"></path></g></svg> Pay with bKash </button></div><div>${props.bkashScript}</div><!--]-->`);
    };
  }
});
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Payment.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const __vite_glob_0_2 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$3
}, Symbol.toStringTag, { value: "Module" }));
const _sfc_main$2 = {
  __name: "Pricings",
  __ssrInlineRender: true,
  props: {
    "pricings": Array,
    "school": Array | Object,
    "message": String
  },
  setup(__props) {
    const form = reactive({
      amount: null,
      id: null
    });
    reactive({
      id: null
    });
    const props = __props;
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), null, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<title${_scopeId}>Contact - RCT ems</title><meta name="keywords" content="RCT Seba, RCT ems, ems, lms"${_scopeId}><link rel="preconnect" href="https://fonts.googleapis.com"${_scopeId}><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin${_scopeId}><link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&amp;display=swap" rel="stylesheet"${_scopeId}>`);
          } else {
            return [
              createVNode("title", null, "Contact - RCT ems"),
              createVNode("meta", {
                name: "keywords",
                content: "RCT Seba, RCT ems, ems, lms"
              }),
              createVNode("link", {
                rel: "preconnect",
                href: "https://fonts.googleapis.com"
              }),
              createVNode("link", {
                rel: "preconnect",
                href: "https://fonts.gstatic.com",
                crossorigin: ""
              }),
              createVNode("link", {
                href: "https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap",
                rel: "stylesheet"
              })
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<section class="min-h-screen bg-gradient-to-tr from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]" style="${ssrRenderStyle({ "font-family": "'Jost', sans-serif" })}"><div class="container py-12 mx-auto"><h2 class="text-3xl uppercase mb-4 pb-2 border-b border-emerald-500 text-center font-extrabold">Our Pricings </h2><div class="relative z-10 overflow-hidden rounded-sm border border-stroke bg-white p-11 shadow-default dark:border-strokedark dark:bg-boxdark"><div class="w-full overflow-x-auto"><table class="table-auto w-full"><thead><tr><th class="w-1/4 min-w-[200px] px-5"></th><!--[-->`);
      ssrRenderList(props.pricings, (pricing) => {
        _push(`<th class="w-1/4 min-w-[200px] px-5"><form><div class="mb-10 text-left"><span class="mb-3.5 block text-xl font-bold text-black dark:text-white">${ssrInterpolate(pricing.name)}</span><h4 class="mb-4"><span class="text-[28px] font-bold text-black dark:text-white lg:text-[32px]"><sup class="font-xs">৳</sup> ${ssrInterpolate(pricing.price ?? 0)}</span><sub class="font-xs">/ Month</sub></h4><p class="mb-6 text-base font-medium">${ssrInterpolate(pricing.additional_features)}</p><button style="${ssrRenderStyle(props.school !== null && props.school.package_id == null ? null : { display: "none" })}"${ssrIncludeBooleanAttr(form.processing) ? " disabled" : ""} class="block w-full rounded-md bg-primary p-3 text-center font-medium text-white transition hover:bg-opacity-90" type="submit">${ssrInterpolate(pricing.price > 0 ? "Purchase Now" : "Free")}</button></div></form></th>`);
      });
      _push(`<!--]--></tr></thead><tbody><tr><td class="border-t border-r border-stroke py-5 px-7 dark:border-strokedark border-l"><h5 class="font-medium text-black dark:text-white">Key Features</h5></td><!--[-->`);
      ssrRenderList(props.pricings, (pricing) => {
        _push(`<td class="border-t border-r border-stroke py-5 px-7 dark:border-strokedark"><h5 class="font-medium text-black dark:text-white">Key Features</h5></td>`);
      });
      _push(`<!--]--></tr><tr><td class="border-l border-t border-r border-b border-stroke py-5 px-7 dark:border-strokedark"><p class="font-medium">Allowed students</p></td><!--[-->`);
      ssrRenderList(props.pricings, (pricing) => {
        _push(`<td class="border-t border-l border-stroke py-5 px-7 dark:border-strokedark border-b border-r"><p class="text-center font-medium">${ssrInterpolate(pricing.allowed_students)}</p></td>`);
      });
      _push(`<!--]--></tr></tbody></table></div><div class="absolute top-0 left-0 -z-1"><span class="absolute top-0 left-0 -z-1"><svg width="213" height="188" viewBox="0 0 213 188" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="75" cy="50" r="138" fill="url(#paint0_linear)"></circle><defs><linearGradient id="paint0_linear" x1="75" y1="-88" x2="75" y2="188" gradientUnits="userSpaceOnUse"><stop stop-color="#3056D3" stop-opacity="0.15"></stop><stop offset="1" stop-color="#C4C4C4" stop-opacity="0"></stop></linearGradient></defs></svg></span><span class="absolute top-30 left-11 -z-1"><svg width="50" height="109" viewBox="0 0 50 109" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="47.71" cy="107.259" r="1.74121" transform="rotate(180 47.71 107.259)" fill="#3056D3"></circle><circle cx="47.71" cy="91.9355" r="1.74121" transform="rotate(180 47.71 91.9355)" fill="#3056D3"></circle><circle cx="47.71" cy="76.6133" r="1.74121" transform="rotate(180 47.71 76.6133)" fill="#3056D3"></circle><circle cx="47.71" cy="47.0132" r="1.74121" transform="rotate(180 47.71 47.0132)" fill="#3056D3"></circle><circle cx="47.71" cy="16.7158" r="1.74121" transform="rotate(180 47.71 16.7158)" fill="#3056D3"></circle><circle cx="47.71" cy="61.6392" r="1.74121" transform="rotate(180 47.71 61.6392)" fill="#3056D3"></circle><circle cx="47.71" cy="32.0386" r="1.74121" transform="rotate(180 47.71 32.0386)" fill="#3056D3"></circle><circle cx="47.71" cy="1.74121" r="1.74121" transform="rotate(180 47.71 1.74121)" fill="#3056D3"></circle><circle cx="32.3877" cy="107.259" r="1.74121" transform="rotate(180 32.3877 107.259)" fill="#3056D3"></circle><circle cx="32.3877" cy="91.9355" r="1.74121" transform="rotate(180 32.3877 91.9355)" fill="#3056D3"></circle><circle cx="32.3877" cy="76.6133" r="1.74121" transform="rotate(180 32.3877 76.6133)" fill="#3056D3"></circle><circle cx="32.3877" cy="47.0132" r="1.74121" transform="rotate(180 32.3877 47.0132)" fill="#3056D3"></circle><circle cx="32.3877" cy="16.7158" r="1.74121" transform="rotate(180 32.3877 16.7158)" fill="#3056D3"></circle><circle cx="32.3877" cy="61.6392" r="1.74121" transform="rotate(180 32.3877 61.6392)" fill="#3056D3"></circle><circle cx="32.3877" cy="32.0386" r="1.74121" transform="rotate(180 32.3877 32.0386)" fill="#3056D3"></circle><circle cx="32.3877" cy="1.74121" r="1.74121" transform="rotate(180 32.3877 1.74121)" fill="#3056D3"></circle><circle cx="17.0654" cy="107.259" r="1.74121" transform="rotate(180 17.0654 107.259)" fill="#3056D3"></circle><circle cx="17.0654" cy="91.9355" r="1.74121" transform="rotate(180 17.0654 91.9355)" fill="#3056D3"></circle><circle cx="17.0654" cy="76.6133" r="1.74121" transform="rotate(180 17.0654 76.6133)" fill="#3056D3"></circle><circle cx="17.0654" cy="47.0132" r="1.74121" transform="rotate(180 17.0654 47.0132)" fill="#3056D3"></circle><circle cx="17.0654" cy="16.7158" r="1.74121" transform="rotate(180 17.0654 16.7158)" fill="#3056D3"></circle><circle cx="17.0654" cy="61.6392" r="1.74121" transform="rotate(180 17.0654 61.6392)" fill="#3056D3"></circle><circle cx="17.0654" cy="32.0386" r="1.74121" transform="rotate(180 17.0654 32.0386)" fill="#3056D3"></circle><circle cx="17.0654" cy="1.74121" r="1.74121" transform="rotate(180 17.0654 1.74121)" fill="#3056D3"></circle><circle cx="1.74121" cy="107.259" r="1.74121" transform="rotate(180 1.74121 107.259)" fill="#3056D3"></circle><circle cx="1.74121" cy="91.9355" r="1.74121" transform="rotate(180 1.74121 91.9355)" fill="#3056D3"></circle><circle cx="1.74121" cy="76.6133" r="1.74121" transform="rotate(180 1.74121 76.6133)" fill="#3056D3"></circle><circle cx="1.74121" cy="47.0132" r="1.74121" transform="rotate(180 1.74121 47.0132)" fill="#3056D3"></circle><circle cx="1.74121" cy="16.7158" r="1.74121" transform="rotate(180 1.74121 16.7158)" fill="#3056D3"></circle><circle cx="1.74121" cy="61.6392" r="1.74121" transform="rotate(180 1.74121 61.6392)" fill="#3056D3"></circle><circle cx="1.74121" cy="32.0386" r="1.74121" transform="rotate(180 1.74121 32.0386)" fill="#3056D3"></circle><circle cx="1.74121" cy="1.74121" r="1.74121" transform="rotate(180 1.74121 1.74121)" fill="#3056D3"></circle></svg></span></div></div></div></section><!--]-->`);
    };
  }
};
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Pricings.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const __vite_glob_0_3 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$2
}, Symbol.toStringTag, { value: "Module" }));
const _sfc_main$1 = {
  __name: "FlashMessage",
  __ssrInlineRender: true,
  props: {
    messages: Object,
    package_purchased: String
  },
  setup(__props) {
    usePage();
    const props = __props;
    watch(() => props.messages, async (value) => {
      await flasher.render(value);
    }, { deep: true });
    return (_ctx, _push, _parent, _attrs) => {
      if (_ctx.$page.props.flash.message || _ctx.$page.props.flash.package_purchased) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "fixed left-0 right-0 z-[999] w-[90vw] mx-auto rounded-md mt-3 py-5 transition-all ease-in-out duration-400 bg-[#fea50098] pl-6 pr-4 flex items-center justify-between backdrop-blur-lg" }, _attrs))}><span class="text-md font-bold" style="${ssrRenderStyle({ "font-family": "'Jost', sans-serif" })}">${ssrInterpolate(_ctx.$page.props.flash.message)}</span><div>`);
        _push(ssrRenderComponent(unref(XCircle), { class: "cursor-pointer" }, null, _parent));
        _push(`</div></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/FlashMessage.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const Layout_vue_vue_type_style_index_0_lang = "";
document.addEventListener("DOMContentLoaded", function() {
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  const closeButton = document.querySelector("#mobile-menu .close-button");
  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.remove("hidden");
    mobileMenu.style.transform = "translateX(0)";
  });
  closeButton.addEventListener("click", () => {
    mobileMenu.classList.add("hidden");
    mobileMenu.style.transform = "translateX(-100%)";
  });
});
const _sfc_main = {
  __name: "Layout",
  __ssrInlineRender: true,
  setup(__props) {
    const page = usePage();
    const logo = computed(() => page.props.logo);
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<main${ssrRenderAttrs(_attrs)}><nav class="hidden lg:flex bg-sky-500/50 backdrop-blur-2xl border-sky-500 border-b p-4 fixed w-full top-0 z-50"><div class="container mx-auto flex justify-between items-center"><div><img${ssrRenderAttr("src", "/storage/" + logo.value)} class="w-[40px]" alt=""></div><div class="flex gap-2 flex-wrap items-end justify-end">`);
      _push(ssrRenderComponent(unref(Link), {
        class: ["px-2 py-1", { "bg-emerald-500 rounded": _ctx.$page.url === "/" }],
        href: "/"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`Home `);
          } else {
            return [
              createTextVNode("Home ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(unref(Link), {
        class: ["px-2 py-1", { "bg-emerald-500 rounded": _ctx.$page.url === "/contact" }],
        href: "/contact"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` Contact `);
          } else {
            return [
              createTextVNode(" Contact ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(unref(Link), {
        class: ["px-2 py-1", { "bg-emerald-500 rounded": _ctx.$page.url === "/pricings" }],
        href: "/pricings"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` Pricings`);
          } else {
            return [
              createTextVNode(" Pricings")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(unref(Link), {
        class: "px-2 py-1",
        href: "/app/login"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`Login`);
          } else {
            return [
              createTextVNode("Login")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</div></div></nav><nav class="lg:hidden bg-blue-500 p-4"><div class="container mx-auto"><div class="flex justify-between items-center"><img${ssrRenderAttr("src", "/storage/" + logo.value)} class="w-[60px]" alt=""><button id="mobile-menu-button" class="text-white focus:outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg></button></div></div></nav><div id="mobile-menu" class="hidden"><button class="close-button text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button><div class="flex flex-col items-center mt-4 space-y-4"><img${ssrRenderAttr("src", "/storage/" + logo.value)} class="mw-[100%] mx-3" alt=""><a href="#" class="text-white">Home</a><a href="#" class="text-white">About</a><a href="#" class="text-white">Services</a><a href="#" class="text-white">Contact</a></div></div><article class="mt-[65px]">`);
      _push(ssrRenderComponent(_sfc_main$1, null, null, _parent));
      ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
      _push(`</article><footer class="py-6 px-6 bg-gradient-to-tr from-slate-800 to-slate-600" style="${ssrRenderStyle({ "position": "sticky", "width": "100%", "bottom": "0", "left": "0", "right": "0", "z-index": "-1" })}"><div class="flex flex-wrap"><div class="w-full flex justify-center"><p class="text-white">আরসিটি ইএমএস ২০২৩ | আরসিটি সেবার একটি পণ্য | সর্বসত্ব সংরক্ষিত</p></div></div></footer></main>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Layout.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
createServer(
  (page) => createInertiaApp({
    id: "app",
    page,
    render: renderToString,
    resolve: (name) => {
      const pages = /* @__PURE__ */ Object.assign({ "./Pages/Contact.vue": __vite_glob_0_0, "./Pages/Home.vue": __vite_glob_0_1, "./Pages/Payment.vue": __vite_glob_0_2, "./Pages/Pricings.vue": __vite_glob_0_3 });
      let page2 = pages[`./Pages/${name}.vue`];
      page2.default.layout = page2.default.layout || _sfc_main;
      return page2;
    },
    setup({ el, App, props, plugin }) {
      return createSSRApp({
        render: () => h(App, props)
      }).use(Toast).use(plugin).mount(el);
    }
  })
);
