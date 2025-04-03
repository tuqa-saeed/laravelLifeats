// order_report_csv.js
window.generateCSV = async function () {
    const spinnerOverlay = document.getElementById("spinner-overlay");
    if (spinnerOverlay) spinnerOverlay.style.display = "block";

    try {
        const res = await fetch(
            "http://127.0.0.1:8000/api/admin/user-subscriptions"
        );
        if (!res.ok) throw new Error("Failed to load subscriptions");
        const data = await res.json();

        const headers = ["ID", "User Name", "Email", "Subscription", "Status"];
        const rows = data.map((sub) => [
            sub.id,
            sub.user?.name || "N/A",
            sub.user?.email || "N/A",
            sub.subscription?.name || "N/A",
            sub.status || "N/A",
        ]);

        let csv = headers.join(",") + "\n";
        csv += rows.map((r) => r.join(",")).join("\n");

        const blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.setAttribute("download", "user_subscriptions_report.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (err) {
        alert("CSV Export Failed: " + err.message);
    } finally {
        if (spinnerOverlay) spinnerOverlay.style.display = "none";
    }
};
