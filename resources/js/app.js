import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	const sidebar = document.querySelector('[data-sidebar]');
	const overlay = document.querySelector('[data-sidebar-overlay]');
	const toggles = document.querySelectorAll('[data-sidebar-toggle]');
	const progressBars = document.querySelectorAll('[data-width]');

	if (!sidebar || !overlay || toggles.length === 0) {
		progressBars.forEach((bar) => {
			const width = bar.getAttribute('data-width');
			if (width) {
				bar.style.width = `${width}%`;
			}
		});

		return;
	}

	const openSidebar = () => {
		sidebar.classList.remove('-translate-x-full');
		overlay.classList.remove('hidden');
		document.body.classList.add('overflow-hidden');
	};

	const closeSidebar = () => {
		sidebar.classList.add('-translate-x-full');
		overlay.classList.add('hidden');
		document.body.classList.remove('overflow-hidden');
	};

	toggles.forEach((toggle) => {
		toggle.addEventListener('click', openSidebar);
	});

	overlay.addEventListener('click', closeSidebar);

	window.addEventListener('resize', () => {
		if (window.innerWidth >= 1024) {
			closeSidebar();
		}
	});

	progressBars.forEach((bar) => {
		const width = bar.getAttribute('data-width');
		if (width) {
			bar.style.width = `${width}%`;
		}
	});
});
