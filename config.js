// config.js
const CONFIG = {
    ACCESS_TOKEN: process.env.NEXT_PUBLIC_GOOGLE_ACCESS_TOKEN, // Vercel environment variable
    PROPERTY_ID: process.env.NEXT_PUBLIC_GOOGLE_PROPERTY_ID,   // Vercel environment variable
};

window.CONFIG = CONFIG; // Make CONFIG globally available
