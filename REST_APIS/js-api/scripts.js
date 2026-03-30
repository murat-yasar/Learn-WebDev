async function callAPI() {
	const input = document.getElementById("url-input");
	const result = document.getElementById("result");
	const btn = document.getElementById("submit-btn");
	const url = input.value.trim();

	// Clear previous result
	result.innerHTML = "";

	// Basic validation
	if (!url) {
		showWarning("Please enter a URL.");
		return;
	}

	try {
		new URL(url);
	} catch {
		showWarning("That does not look like a valid URL.");
		return;
	}

	// Disable button while loading
	btn.disabled = true;
	btn.textContent = "Loading…";

	try {
		const response = await fetch(url);

		// Try to parse as JSON
		const text = await response.text();
		let parsed;

		try {
			parsed = JSON.parse(text);
		} catch {
			showWarning(
				"The URL responded, but did not return valid JSON. This may not be a REST API.",
			);
			return;
		}

		// Success — display pretty-printed JSON
		const pre = document.createElement("pre");
		pre.textContent = JSON.stringify(parsed, null, 2);
		result.appendChild(pre);
	} catch (err) {
		showWarning(
			"Could not reach that address. Is it a valid, publicly accessible URL?",
		);
	} finally {
		btn.disabled = false;
		btn.textContent = "Submit";
	}
}

function showWarning(message) {
	const result = document.getElementById("result");
	result.innerHTML = `<div class="warning">⚠️ ${message}</div>`;
}

// Allow pressing Enter to submit
document.getElementById("url-input").addEventListener("keydown", (e) => {
	if (e.key === "Enter") callAPI();
});
