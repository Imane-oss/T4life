<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Professionnelle</title>
    <style>
        /* --- CSS: Design o Styling --- */
        :root {
            --primary-color: #2c3e50; /* Loun kahl (Dark Blue) */
            --accent-color: #3498db;  /* Loun zar9a (Blue) */
            --bg-color: #f8f9fa;      /* Loun l5alfiya */
            --text-color: #333;
            --border-radius: 8px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .faq-container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .faq-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .faq-header h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .faq-header p {
            color: #666;
        }

        /* Styling dyal details o summary */
        details {
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            overflow: hidden;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        details:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-color: var(--accent-color);
        }

        summary {
            padding: 20px;
            cursor: pointer;
            font-weight: 600;
            color: var(--primary-color);
            list-style: none; /* Bach n7yiw ltriangle dyal default */
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Icon + bach tbdel */
        summary::after {
            content: '+';
            font-size: 24px;
            color: var(--accent-color);
            transition: transform 0.3s ease;
        }

        details[open] summary::after {
            transform: rotate(45deg); /* Ywli - ila tet7el */
        }

        details[open] summary {
            border-bottom: 1px solid #eee;
            background-color: #fafafa;
        }

        .faq-content {
            padding: 20px;
            color: #555;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive l Mobile */
        @media (max-width: 600px) {
            .faq-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="faq-container">
        <div class="faq-header">
            <h1>FAQ</h1>
            <p>Suggested questions</p>
        </div>

        <!-- Item 1 -->
        <details>
            <summary>Quels sont vos modes de paiement acceptés ?</summary>
            <div class="faq-content">
                Nous acceptons les paiements par carte bancaire (Visa, MasterCard), PayPal ainsi que le paiement à la livraison pour certaines localités. Toutes les transactions sont sécurisées.
            </div>
        </details>

        <!-- Item 2 -->
        <details>
            <summary>Comment se passe la garantie des produits ?</summary>
            <div class="faq-content">
                Tous nos produits bénéficient d'une garantie légale de conformité de 1 an. En cas de défaut de fabrication, vous pouvez nous retourner le produit pour un échange ou un remboursement complet.
            </div>
        </details>

        <!-- Item 3 -->
        <details>
            <summary>Puis-je annuler ma commande après validation ?</summary>
            <div class="faq-content">
                Oui, vous disposez d'un délai de 2 heures après la validation pour annuler votre commande. Passé ce délai, veuillez contacter notre service client pour vérifier l'état d'expédition.
            </div>
        </details>

        <!-- Item 4 -->
        <details>
            <summary>Quels sont les délais de livraison ?</summary>
            <div class="faq-content">
                Les délais de livraison varient entre 24h et 72h selon votre ville de résidence. Vous recevrez un numéro de suivi par SMS et email dès l'expédition de votre colis.
            </div>
        </details>

        <!-- Item 5 -->
        <details>
            <summary>Mes données personnelles sont-elles sécurisées ?</summary>
            <div class="faq-content">
                Absolument. Nous nous engageons à respecter la réglementation en vigueur regarding la protection des données personnelles. Vos informations ne seront jamais revendues à des tiers.
            </div>
        </details>

    </div>

</body>
</html>