// config.js
const CONFIG = {
    PROPERTY_ID: process.env.NEXT_PUBLIC_GOOGLE_PROPERTY_ID,   // Vercel environment variable for property ID
};

// Make CONFIG globally available for use
window.CONFIG = CONFIG;
