// delivery_report.js
window.generateDeliveryPDF = async function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const spinnerOverlay = document.getElementById("spinner-overlay");
    if (spinnerOverlay) spinnerOverlay.style.display = "block";

    try {
        const res = await fetch(
            "http://127.0.0.1:8000/api/admin/meal-schedules"
        );
        if (!res.ok) throw new Error("Failed to load meal schedules");
        const data = await res.json();

        const today = new Date();
        const todayStr = today.toISOString().split("T")[0];

        // Only schedules for today's date
        const filtered = data.filter((s) => s.date === todayStr);

        doc.setFontSize(16);
        doc.text(`Delivery Meal Report (${todayStr})`, 14, 20);
        doc.setFontSize(11);

        let y = 30;

        for (const schedule of filtered) {
            const user = schedule.user_subscription.user;
            const selections = schedule.selections;

            // Get selected meals, or pick one per category if none selected
            let meals = selections.filter((sel) => sel.selected === 1);
            if (meals.length === 0) {
                const categoryMap = new Map();
                selections.forEach((sel) => {
                    if (!categoryMap.has(sel.category_id)) {
                        categoryMap.set(sel.category_id, sel);
                    }
                });
                meals = Array.from(categoryMap.values());
            }

            // User header
            doc.setFont(undefined, "bold");
            doc.text(`User: ${user.name} (${user.email})`, 14, y);
            y += 6;
            doc.text(
                `Address: ${user.address} | Date: ${schedule.date}`,
                14,
                y
            );
            y += 8;

            // Meals section
            doc.setFont(undefined, "normal");
            meals.forEach((sel, index) => {
                const meal = sel.meal;
                doc.setFont(undefined, "bold");
                doc.text(`• ${meal.name}`, 16, y);
                y += 6;

                doc.setFont(undefined, "normal");
                if (meal.details) {
                    doc.text(`Details: ${meal.details}`, 20, y);
                    y += 6;
                } else {
                    doc.text(`Details: —`, 20, y);
                    y += 6;
                }

                // Page break
                if (y > 270) {
                    doc.addPage();
                    y = 20;
                }
            });

            y += 10;
        }

        doc.save("delivery_meal_report.pdf");
    } catch (err) {
        alert("PDF Export Failed: " + err.message);
    } finally {
        if (spinnerOverlay) spinnerOverlay.style.display = "none";
    }
};
