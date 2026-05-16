document.addEventListener("DOMContentLoaded", () => {
  const steps = [
    {
      id: 1,
      type: "single",
      title: "We have an active business website",
      options: ["Yes", "No"]
    },
    {
    id: 2,
      type: "url",
      label: "ENTER A URL",
      title: "What’s your business website?",
      checkbox: "My business sells to other businesses (B2B)"
    },
    {
      id: 3,
      type: "multi",
      label: "SELECT ALL THAT APPLY",
      title: "Collects Lead",
      subtitle: "Select all that apply to your business",
      options: [
        "All contacts are organized in one place where the whole team can access them",
        "There are lead generating offers on our website",
        "We can scan business cards to automatically add contact info our CRM",
        "Our dashboard shows leads as they come in",
        "Leads are tagged or segmented into relevant groups such as lead source, pipeline stage, and pain point",
        "Lead scoring is in place to identify which ones are most likely to convert",
        "None of the above"
      ]
    },
    {
      id: 4,
      type: "single",
      title: "How many employees do you have ? (Include yourself)",
      subtitle: "Select one",
      options: ["1", "2–3", "4–10", "11–15", "26+"]
    },
    {
      id: 5,
      type: "multi",
      label: "SELECT ALL THAT APPLY",
      title: "Converting Clients z",
      subtitle: "Select all that apply to your business",
      options: [
        "Automated messages (email or text) are sent to every new lead",
        "Automated scheduling allows customers to schedule appointments online",
        "Appointment reminders are sent out automatically",
        "The business can accept online payments",
        "Email nurture campaigns automatically follow up with all leads",
        "None of the above"
      ]
    },
    {
      id: 6,
      type: "multi",
      label: "SELECT ALL THAT APPLY",
      title: "Converting Clients (Pt-2)",
      subtitle: "Select all that apply to your business",
      options: [
        "Campaigns include automated text messages",
        "An abandoned-cart nurture is in place",
        "Prospects receive personalized offers based on lead score",
        "The ROI of marketing investments is effectively tracked",
        "Multiple sales funnels for various products and revenue streams are in place",
        "The business has a proven marketing strategy that we are confident in",
        "None of the above"
      ]
    },
    {
      id: 7,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Which category does your business fall under?",
      subtitle: "Select one",
      options: [
        "Consultants",
        "Coaches",
        "Marketing Agencies",
        "Professional Services",
        "Startups",
        "Health and Wellness",
        "E-commerce",
        "Others",
      ]
    },
    {
      id: 8,
      type: "multi",
      label: "SELECT ALL THAT APPLY",
      title: "Creating Fans",
      subtitle: "Select all that apply to your business",
      options: [
        "We deliver a consistent experience to every new customer",
        "Our customer onboarding process is automated and consistent",
        "Reviews and referrals requests are automated",
        "Customers are automatically notified of failed payments and expiring credit cards",
        "Customers are automatically sent upsell offers",
        "We regularly send an email newsletter with our newest content",
        "None of the above"
      ]
    },
    {
      id: 9,
      type: "ads-flow",
      label: "SELECT ALL THAT APPLY",
      screens: [
        {
          key: "platforms",
          title: "What types of paid Ads campaign are you currently using?",
          subtitle: "Select all that apply to your business",
          options: [
            { value: "facebook", label: "FACEBOOK ADS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo1.png" },
            { value: "youtube", label: "YOUTUBE ADS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo2.png" },
            { value: "google", label: "GOOGLE ADS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo3.png" },
            { value: "x", label: "X ADS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo4.png" },
            { value: "linkedin", label: "LINKEDIN ADS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo5.png" },
            { value: "tiktok", label: "TIKTOK ADS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo6.png" },
            { value: "others", label: "OTHERS", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo7.png" },
            { value: "none", label: "NONE", icon: "https://cdn.electricoctopus.agency/electric-octopus/ads-logo8.png" }
          ],
          type: "multi"
        },
        {
          key: "monthly_spend",
          title: "Do you have an agency or internal team member to manage ads?",
          subtitle: "Select all that apply to your business",
          lpQuestion:
            "Do you have an agency or internal team member who can build landing pages or update your website?",
          lpOptions: ["In-house Team", "Agency"],
          question: "How much do you spend on paid ads each month?",
          options: [
            "$5,000 – $10,000",
            "$10,000 – $50,000",
            "$50,000 – $100,000",
            "$100,000 +"
          ],
          type: "single"
        },
        {
          key: "performance",
          title: "Do you have an agency or internal team member who can build landing pages or update your website?",
          subtitle: "Select all that apply to your business",
          subheading: "What is  the  conversion rates for the Ads campaigns you are running ?",
          inputs: 4,
           val: ["111", "111", "111", "111"],
          lpQuestion:
            "Do you have an agency or internal team member who can build landing pages or update your website?",
          lpOptions: ["In-house Team", "Agency"]
        }
      ]
    },
    {
      id: 10,
      type: "ads-flow",
      label: "SELECT ALL THAT APPLY",
      screens: [
        {
          key: "content_ops_pt1",
          title: "What Type of content Ops campaign are you currently have ? (Pt-1)",
          subtitle: "Select all that apply to your business",
          // type: "multi",
          layout: "list", // 🔥 NEW
          options: [
            { label: "Product SEO", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon1.png" 
            },
            { label: "content strategy", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon2.png" 
            },
            { label: "Content Marketing", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon3.png" 
            },
            { label: "Content Localisation", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon4.png" 
            },
            { label: "None of the Above", 
              para: "", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon5.png" 
            },
          ],
        },
        {
          key: "content_ops_pt2",
          title: "What Type of content Ops campaign are you currently have ? (Pt-2)",
          subtitle: "Select all that apply to your business",
          layout: "list", // 🔥 NEW
          options: [
            { label: "Link Building", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon6.png" 
            },
            { label: "Digital AD", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon7.png" 
            },
            { label: "Visual Links", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon8.png" 
            },
            { label: "Guest Portal", 
              para: "Take the assessment to find out what small business stage you’re in and how to break through to the next level.", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon9.png" 
            },
            { label: "None of the Above", 
              para: "", 
              icon: "https://cdn.electricoctopus.agency/electric-octopus/product-icon5.png" 
            },
          ],
        },
        {
          key: "performance",
          title: "What is your estimated monthly spend ?",
          subtitle: "Select all that apply to your business",
          subheading:"",
          type: "single",
          lpOptions: ["",""],
          inputs: 4,
           val: [
            "Less than $5,000 ", 
            "$5,000 - $10,000 ", 
            "$10,000-$25,000", 
            "$25,000 +"
          ],
          // options: [
          //   "Less than $5,000",
          //   "$5,000 - $10,000",
          //   "$10,000 - $25,000",
          //   "$25,000 +"
          // ],
          lpQuestion: "What best describe your current content Ops team ?",
          lpOptions: [
            "We have a in-house team",
            "We work with multiple providers ( Agency , Consultant , Freelancers )"
          ]
        }
      ]
    },
    {
      id: 11,
      type: "ads-flow",
      label: "SELECT ALL THAT APPLY",
      screens: [
        {
          key: "crm_tools_pt1", // ✅ unique
          type: "multi",
          title: "Which CRM do you currently use? (Pt-1)",
          subtitle: "Select all that apply to your business",
          iconOnly: true,
          options: [
            { value: "zendesk", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo1.png" },
            { value: "insightly", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo2.png" },
            { value: "hubspot", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo3.png" },
            { value: "less annoying", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo4.png" },
            { value: "creatio", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo5.png" },
            { value: "sateforce", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo6.png" },
            { value: "zoho", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo7.png" },
            { value: "copper", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo8.png" },
            { value: "apptivo", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo9.png" },
            { value: "quickbase", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo10.png" },
            { value: "nimmble", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo11.png" },
            { value: "capsule", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo12.png" },

          ]
        },
        {
          key: "crm_tools_pt2", // ✅ unique
          type: "multi",
          title: "Which CRM do you currently use? (Pt-2)",
          subtitle: "Select all that apply to your business",
          iconOnly: true,
          options: [
            { value: "zendesk", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo1.png" },
            { value: "insightly", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo2.png" },
            { value: "hubspot", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo3.png" },
            { value: "less annoying", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo4.png" },
            { value: "creatio", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo5.png" },
            { value: "sateforce", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo6.png" },
            { value: "zoho", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo7.png" },
            { value: "copper", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo8.png" },
            { value: "apptivo", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo9.png" },
            { value: "quickbase", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo10.png" },
            { value: "nimmble", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo11.png" },
            { value: "capsule", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-logo12.png" },

          ]
        }
      ]
    },

    {
      id: 12,
      type: "ads-flow",
      label: "SELECT ALL THAT APPLY",
      screens: [
        {
          key: "crm_integrated", // ✅ REQUIRED
          type: "single",
          title: "Is your CRM integrated with core 3rd party applications?",
          subtitle: "Select that apply to your business",
          options: ["Yes", "No"]
        },
        {
          key: "crm_integrations_pt1",
          type: "multi",
          iconOnly: true,
          title: "What Type of CRM integration and automation are you currently have ? (Part -1)",
          subtitle: "Select all that apply to your business",
          options: [
            { value: "outreach", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type1.png" },
            { value: "instantly", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type2.png" },
            { value: "close", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type3.png" },
            { value: "oroove", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type4.png" },
            { value: "appolo", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type5.png" },
            { value: "smartlead", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type6.png" },
            { value: "lemlist", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type7.png" },
            { value: "mixmax", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type8.png" },
            { value: "salesloft", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type9.png" },
            { value: "highlevel", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type10.png" },
            { value: "gol", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type11.png" },
            { value: "reply", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type12.png" },
          ]
        },
        {
          key: "crm_integrations_pt2",
          type: "multi",
          iconOnly: true,
          title: "What Type of CRM integration and automation are you currently have ? (Part -2)",
          subtitle: "Select all that apply to your business",
          options: [
            { value: "click funnel", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type13.png" },
            { value: "calendly", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type14.png" },
            { value: "trigify", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type15.png" },
            { value: "gotowebinar", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type16.png" },
            { value: "hootsuit", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type17.png" },
            { value: "smartlead", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type6.png" },
            { value: "lemlist", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type7.png" },
            { value: "mixmax", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type8.png" },
            { value: "salesloft", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type9.png" },
            { value: "highlevel", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type10.png" },
            { value: "gol", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type11.png" },
            { value: "reply", icon: "https://cdn.electricoctopus.agency/electric-octopus/crm-type12.png" },
          ]
        }
      ]
    },

    {
      id: 13,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Are your GTM setup and performing basic daily tasks in your CRM?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 14,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Is your CRM the source of truth for customer information?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 15,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Are your GTM team’s goals tracked in the CRM?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 16,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Can you clearly segment & report on your customer journey from Lead to Closed Won Revenue?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 17,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Can you break down primary KPIs by who, what, where, when to answer why the business & teams have performed historically?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 18,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Do you know which primary KPIs are allowing/preventing you from hitting your revenue goals?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 19,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Can you accurately forecast future revenue and metrics with less than 5% margin of error?*",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 20,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Do you have a list of prioritized secondary KPIs to segment the business by?",
      subtitle: "Select that apply to your business",
      options: [
        "Yes",
        "No",
       
      ]
    },
    {
      id: 21,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "Operations",
      subtitle: "Select that apply to your business",
      options: [
        "Our team members receive internal reminders for important tasks",
        "Task lists are automatically generated for recurring tasks",
        "We have a seamless process for data entry, such as internal forms for taking information over the phone or gathering feedback from an employee survey",
        "Our hiring process includes automated steps, such as application collection, signature requests, task assignments, and appointment setting.",
       
      ]
    },
    {
      id: 22,
      type: "single",
      label: "SELECT ALL THAT APPLY",
      title: "What area of the business do you work in?",
      subtitle: "Select one",
      options: [
        "Owner / Founder / CEO",
        "Operations",
        "Sales",
        "Marketing",
        "Project Management / Admin",
        "Product / Developer",
        "Other",
       
      ]
    },
    // 👉 ADD STEPS 5–12 HERE (same structure)
  ];

  
  let currentStep = 0;
  let currentSubStep = 0; // 🔥 ONLY used for step 9
  const answers = {};

  const stepContent = document.getElementById("step-content");
  const indicator = document.getElementById("step-indicator");
  const prevBtn = document.getElementById("prev-step");
  const nextBtn = document.getElementById("next-step");

  function renderStep() {
  const wrapper = document.querySelector(".assessment-wrapper");
  const step = steps[currentStep];

  // ---------- Wrapper / Header ----------
if (wrapper) {
  wrapper.classList.toggle("first-step", currentStep === 0);
}

  const title = document.getElementById("assessment-title");
  const desc = document.getElementById("assessment-desc");

  if (currentStep === 0) {
    title.textContent = "Discover your path to small business growth";
    desc.textContent =
      "Based on the information you provided on the form, it doesn’t look like we’d be a good fit for you as our minimum client engagement begins at $6,000 per month.";
  } else {
    title.textContent = "GET 3 resources to overcome your biggest obstacle";
    desc.textContent =
      "Take the assessment to find out what small business stage you’re in and how to break through to the next level.";
  }

  indicator.innerHTML = `${currentStep + 1} / <span class="total-steps">22</span>`;
  prevBtn.disabled = currentStep === 0;

  // ---------- BUILD HTML ----------
  let html = "";

  if (step.label) {
    html += `<span class="step-label">${step.label}</span>`;
  }

  if (step.title) {
    html += `<h2>${step.title}</h2>`;
  }

  if (step.subtitle) {
    html += `<p class="subtitle">${step.subtitle}</p>`;
  }

  /* ---------- NORMAL OPTIONS ---------- */
  if (step.type === "single" || step.type === "multi") {
    html += `<div class="options">`;
    step.options.forEach(opt => {
      const active =
        step.type === "single"
          ? answers[step.id] === opt
          : (answers[step.id] || []).includes(opt);

      html += `
        <button
          class="commonoption-cls option ${active ? "active" : ""}"
          data-step="${step.id}"
          data-type="${step.type}"
          data-value="${opt}"
        >
          ${opt}
        </button>
      `;
    });
    html += `</div>`;
  }

  /* ---------- URL STEP ---------- */
  if (step.type === "url") {
    html += `
      <input
        type="url"
        id="business-url"
        placeholder="www.yourcompany.com"
        value="${answers[step.id] || ""}"
      />

      <span class="error-message" id="url-error">
        Please enter the correct business website.
      </span>

      <label class="checkbox">
        <input type="checkbox"> ${step.checkbox}
      </label>
    `;
  }

/* ---------- STEP 9 / 10 : FLOW ---------- */
if (step.type === "ads-flow") {
  const screen = step.screens[currentSubStep];

  html += `<h2>${screen.title}</h2>`;
  if (screen.subtitle) html += `<p class="subtitle">${screen.subtitle}</p>`;

  /* ---------- SCREEN 1 : CARD GRID ---------- */
  if (screen.type === "multi" && screen.options?.[0]?.label) {

    html += `<div class="ads-grid">`;

    screen.options.forEach(opt => {
      const val = opt.value || opt;
      const active =
        (answers[step.id]?.[screen.key] || []).includes(val);

      html += `
        <div
          class="ads-card ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="${screen.key}"
          data-type="multi"
          data-value="${val}"
        >
          ${opt.icon ? `<div class="ads-img"><img src="${opt.icon}" /></div>` : ""}
          <span>${opt.label || opt}</span>
        </div>
      `;
    });

    html += `</div>`;

  }
  else if (screen.type === "multi" && screen.iconOnly) {

    html += `<div class="icon-grid grid-2">`;

    screen.options.forEach(opt => {
      const val = opt.value;
      const active = (answers[step.id]?.[screen.key] || []).includes(val);

      html += `
        <button
          class="icon-card ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="${screen.key}"
          data-type="multi"
          data-value="${val}"
        >
          <img src="${opt.icon}" />
        </button>
      `;
    });

    html += `</div>`;

    // 👇 input under grid (image requirement)
    html += `
      <input
        class="other-input"
        placeholder="IF OTHER, ENTER THE NAME OF CRM HERE"
      />
    `;
  }

  else if (screen.layout === "list") {
    html += `<div class="options">`;

    screen.options.forEach(opt => {
      const val = opt.value || opt;
      const active =
        (answers[step.id]?.[screen.key] || []).includes(val);

      html += `
        <div
          class="campaign commonoption-cls option ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="${screen.key}"
          data-type="multi"
          data-value="${val}"
        >
        ${opt.icon ? `<div class="ads-icon"><img src="${opt.icon}" /></div>` : ""}
          <div class="campaign-right">
            ${opt.label ? `<h3>${opt.label}</h3>` : ""}
            ${opt.para ? `<p>${opt.para}</p>` : ""}
          </div>
        </div>
      `;
    });

    html += `</div>`;
  }
  else if (screen.type === "single" && screen.options) {
    html += `<div class="options">`;

    screen.options.forEach(opt => {
      const active = answers[step.id]?.[screen.key] === opt;

      html += `
        <button
          class="commonoption-cls option ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="${screen.key}"
          data-type="single"
          data-value="${opt}"
        >
          ${opt}
        </button>
      `;
    });

    html += `</div>`;
  }

  /* ---------- SCREEN 2 : BUTTON OPTIONS ---------- */
  else if (screen.key === "monthly_spend") {
    screen.lpOptions.forEach(opt => {
      const active = answers[step.id]?.lp_team === opt;
      
      html += `
        <button
          class="commonoption-cls option-d option ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="lp_team"
          data-type="single"
          data-value="${opt}"
        >
          ${opt}
        </button>
      `;
    });
    html += `<div class="ads-question">`;
    html += `<p class="subtitle">${screen.question}</p>`;
    html += `<div class="options">`;

    screen.options.forEach(opt => {
      const val = opt.value || opt;
      const label = opt.label || opt;
      const active = answers[step.id]?.[screen.key] === val;

      html += `
        <button
          class="commonoption-cls option ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="${screen.key}"
          data-type="single"
          data-value="${val}"
        >
          ${label}
        </button>
      `;
    });

    html += `</div></div>`;
  }

  /* ---------- SCREEN 3 : INPUT GRID ---------- */
  else if (screen.inputs) {

  /* ✅ SHOW lp_team2 ONLY IN STEP 9 */
  if (step.id === 9) {
    screen.lpOptions.forEach(opt => {
      const active = answers[step.id]?.lp_team2 === opt;

      html += `
        <button
          class="commonoption-cls option-d option ${active ? "active" : ""}"
          data-step="${step.id}"
          data-key="lp_team2"
          data-type="single"
          data-value="${opt}"
        >
          ${opt}
        </button>
      `;
    });
  }

  html += `<h3 class="subheading">${screen.subheading}</h3>`;
  html += `<div class="input-grid">`;

  for (let i = 0; i < screen.inputs; i++) {
    const val = screen.val?.[i] || "";
    const active = answers[step.id]?.conversion_rate?.[i] === val;

    html += `
      <div
        class="commonoption-cls conversion-rate option-d option ${active ? "active" : ""}"
        data-step="${step.id}"
        data-key="conversion_rate"
        data-type="single"
        data-index="${i}"
        data-value="${val}"
      >
        ${val}
      </div>
    `;
  }

  html += `</div>`;

  html += `<h3 class="subheading">${screen.lpQuestion}</h3>`;
  html += `<div class="options">`;

  screen.lpOptions.forEach(opt => {
    const active = answers[step.id]?.lp_team3 === opt;

    html += `
      <button
        class="commonoption-cls option ${active ? "active" : ""}"
        data-step="${step.id}"
        data-key="lp_team3"
        data-type="single"
        data-value="${opt}"
      >
        ${opt}
      </button>
    `;
  });

  html += `</div>`;
}

}



  // ---------- INJECT ----------
  stepContent.innerHTML = html;

  // ---------- HANDLERS ----------
/* ---------- STEP 9 INTERACTIONS ---------- */
stepContent.querySelectorAll(".ads-card, .option, .icon-card").forEach(btn => {

  btn.onclick = () => {
    const stepId = btn.dataset.step;
    const key = btn.dataset.key;
    const type = btn.dataset.type;
    const value = btn.dataset.value;

    answers[stepId] = answers[stepId] || {};

    if (type === "single") {
      answers[stepId][key] = value;
    } else {
      answers[stepId][key] = answers[stepId][key] || [];
      const arr = answers[stepId][key];
      arr.includes(value)
        ? answers[stepId][key] = arr.filter(v => v !== value)
        : arr.push(value);
    }

    renderStep();
  };
});

stepContent.querySelectorAll(".input-grid input").forEach(input => {
  input.oninput = e => {
    answers[9] = answers[9] || {};
    answers[9].conversion_rate = answers[9].conversion_rate || [];
    answers[9].conversion_rate[e.target.dataset.index] = e.target.value;
  };
});

  // OPTION BUTTONS
  stepContent.querySelectorAll(".option:not([data-key])").forEach(btn => {

    btn.onclick = () => {
      const stepId = btn.dataset.step;
      const value = btn.dataset.value;
      const type = btn.dataset.type;
      const blockKey = btn.dataset.block;

      if (step.type === "complex") {
        answers[stepId] = answers[stepId] || {};
        answers[stepId][blockKey] =
          type === "single" ? value :
          answers[stepId][blockKey] || [];

        if (type === "multi") {
          const arr = answers[stepId][blockKey];
          arr.includes(value)
            ? answers[stepId][blockKey] = arr.filter(v => v !== value)
            : arr.push(value);
        }
      } else {
        if (type === "single") {
          answers[stepId] = value;
        } else {
          answers[stepId] = answers[stepId] || [];
          answers[stepId].includes(value)
            ? answers[stepId] = answers[stepId].filter(v => v !== value)
            : answers[stepId].push(value);
        }
      }

      renderStep();
    };
  });

  // INPUT GRID
  stepContent.querySelectorAll(".input-grid input").forEach(input => {
    input.oninput = e => {
      const stepId = e.target.dataset.step;
      const blockKey = e.target.dataset.block;
      const index = e.target.dataset.index;

      answers[stepId] = answers[stepId] || {};
      answers[stepId][blockKey] = answers[stepId][blockKey] || [];
      answers[stepId][blockKey][index] = e.target.value;
    };
  });
}


prevBtn.onclick = () => {
  const step = steps[currentStep];

  // 🔁 Handle ads-flow sub steps
  if (step.type === "ads-flow" && currentSubStep > 0) {
    currentSubStep--;
    renderStep();
    return;
  }

  // 🔥 FIX: If we are on Step 3 AND Step 1 was "No",
  // go back to Step 1 instead of Step 2
  if (currentStep === 2 && answers[1] === "No") {
    currentStep = 0;
    renderStep();
    return;
  }

  // ⬅️ Normal previous
  if (currentStep > 0) {
    currentStep--;
    renderStep();
  }
};


// new
function isStepAnswered(step) {

  // SINGLE
  if (step.type === "single") {
    return !!answers[step.id];
  }

  // MULTI
  if (step.type === "multi") {
    return Array.isArray(answers[step.id]) && answers[step.id].length > 0;
  }

  // URL
  if (step.type === "url") {
    return !!answers[step.id];
  }

  // ADS FLOW
 if (step.type === "ads-flow") {
  const screen = step.screens[currentSubStep];
  const stepAns = answers[step.id] || {};

  // single yes/no
  if (screen.type === "single") {
    return !!stepAns[screen.key];
  }

  // icon multi
  if (screen.type === "multi") {
    return Array.isArray(stepAns[screen.key]) &&
           stepAns[screen.key].length > 0;
  }
}


  return true;
}

nextBtn.onclick = () => {
  const step = steps[currentStep];

  /* 🔥 FINAL STEP → PART 3 (MUST BE FIRST EXIT) */
  if (currentStep === steps.length - 1) {

    sessionStorage.setItem(
      "assessment_part_1_2",
      JSON.stringify(answers)
    );

    window.location.href = "/electric-octopus-wp/talk-to-expert-3";
    // window.location.href = "/talk-to-expert-3/";
    return; // ⛔ STOP EVERYTHING
  }

  // 🔥 STEP 1 → Skip Step 2 if "No"
  if (step.id === 1 && answers[1] === "No") {
    currentStep += 2;
    renderStep();
    return;
  }

  // ✅ Step 2 URL validation
  if (step.type === "url") {
    const input = document.getElementById("business-url");
    const error = document.getElementById("url-error");

    const value = input.value.trim();
    answers[step.id] = value;

    const isValid =
      /^(https?:\/\/)?([\w-]+\.)+[\w-]{2,}(\/.*)?$/.test(value);

    if (!isValid) {
      error.style.display = "block";
      input.classList.add("error");
      input.focus();
      return;
    } else {
      error.style.display = "none";
      input.classList.remove("error");
    }
  }

  // 🔥 ADS FLOW
  if (step.type === "ads-flow") {
    const screen = step.screens[currentSubStep];

    /* 🔥 STEP 12 CONDITIONAL */
    if (step.id === 12 && screen.key === "crm_integrated") {
      if (answers[12]?.crm_integrated === "No") {
        currentSubStep = 0;
        currentStep++;
        renderStep();
        return;
      }
    }

    if (currentSubStep < step.screens.length - 1) {
      currentSubStep++;
      renderStep();
      return;
    } else {
      currentSubStep = 0;
    }
  }

  // ✅ Normal next
  currentStep++;
  renderStep();
};
  renderStep();
});
