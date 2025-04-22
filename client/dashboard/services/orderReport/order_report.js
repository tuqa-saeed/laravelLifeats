// order_report.js
window.generatePDF = async function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const spinnerOverlay = document.getElementById("spinner-overlay");
    if (spinnerOverlay) spinnerOverlay.style.display = "block";

    try {
        const res = await fetch(
            "http://127.0.0.1:8000/api/admin/user-subscriptions"
        );
        if (!res.ok) throw new Error("Failed to load subscriptions");
        const data = await res.json();

        doc.setFontSize(16);
        doc.text("User Subscriptions Report", 14, 20);
        doc.setFontSize(11);

        let y = 30;
        data.forEach((sub) => {
            const line = `#${sub.id} | ${sub.user?.name || "N/A"} | ${
                sub.subscription?.name || "N/A"
            } | ${sub.status || "N/A"} | ${sub.user?.email || "N/A"}`;
            doc.text(line, 14, y);
            y += 10;
            if (y > 280) {
                doc.addPage();
                y = 20;
            }
        });

        doc.save("user_subscriptions_report.pdf");
    } catch (err) {
        alert("PDF Export Failed: " + err.message);
    } finally {
        if (spinnerOverlay) spinnerOverlay.style.display = "none";
    }
};
