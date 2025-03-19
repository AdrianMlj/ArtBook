// config.js
const CONFIG = {
    PROPERTY_ID: process.env.NEXT_PUBLIC_GOOGLE_PROPERTY_ID,  // Accessing Vercel environment variable
};

// Making CONFIG globally available
window.CONFIG = CONFIG;
