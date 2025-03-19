<?php
// Directly define the values here
$googlePropertyId = 'G-7LGXNG8MZK'; // Replace with actual Property ID
$googleApiKey = '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'; // Replace with actual API Key
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
</head>
<body>
    <button onclick="initGoogleAuth()">Se connecter à Google</button>
    <p id="user-count">Chargement...</p>

    <!-- Google Sign-In script -->
    <script async defer src="https://accounts.google.com/gsi/client" onload="initGoogleAuth()"></script>

    <script>
        let accessToken = "";

        // Pass PHP values to JavaScript
        const CONFIG = {
            GOOGLE_PROPERTY_ID: "<?php echo $googlePropertyId; ?>",
            GOOGLE_API_KEY: "<?php echo $googleApiKey; ?>"
        };

        function initGoogleAuth() {
            google.accounts.oauth2.initTokenClient({
                client_id: CONFIG.GOOGLE_API_KEY, // Using the API key from PHP
                scope: "https://www.googleapis.com/auth/analytics.readonly",
                callback: (tokenResponse) => {
                    accessToken = tokenResponse.access_token;
                    console.log("Connexion réussie !");
                    getAnalyticsReport();
                }
            }).requestAccessToken();
        }

        function getAnalyticsReport() {
            fetch(`https://analyticsdata.googleapis.com/v1beta/properties/${CONFIG.GOOGLE_PROPERTY_ID}:runReport`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${accessToken}`,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "dateRanges": [{ "startDate": "7daysAgo", "endDate": "today" }],
                    "metrics": [{ "name": "activeUsers" }]
                })
            })
            .then(response => response.json())
            .then(data => {
                let users = data.rows[0].metricValues[0].value;
                document.getElementById("user-count").innerText = `Utilisateurs actifs : ${users}`;
            })
            .catch(error => console.error("Erreur API :", error));
        }
    </script>
</body>
</html>
