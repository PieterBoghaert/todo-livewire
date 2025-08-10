<!DOCTYPE html>
<html lang="en">

<head>
    <title>Todo App</title>
    @vite(['resources/scss/style.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="warning">
        This browser does not support container style queries. Please use a modern browser like
        Chrome/Edge version 135 or higher.
    </div>
    <main class="page-content wrapper">
        @livewire('todo-list')
    </main>
    @livewireScripts()
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.querySelector('.theme-toggle');

            // Check if @container style() is supported
            function supportsContainerStyleQueries() {
                const container = document.createElement('div');
                container.style.containerType = 'inline-size';
                container.style.color = 'green'; // used in the style query

                const child = document.createElement('div');
                child.className = 'test-style-query';
                container.appendChild(child);

                const style = document.createElement('style');
                style.textContent = `
    @container style(color: green) {
      .test-style-query {
        --style-query-result: success;
      }
    }
  `;
                document.head.appendChild(style);
                document.body.appendChild(container);

                const result = getComputedStyle(child).getPropertyValue('--style-query-result');

                // Clean up
                container.remove();
                style.remove();

                return result.trim() === 'success';
            }

            themeToggle.addEventListener('click', () => {
                const currentTheme = themeToggle.dataset.theme;

                const newTheme = currentTheme === 'light' ? 'dark' : 'light';

                if (!document.startViewTransition) {
                    updateTheme(newTheme);
                    return;
                }

                document.startViewTransition(() => {
                    updateTheme(newTheme);
                });
            });

            function updateTheme(newTheme) {
                console.log('Updating theme to:', newTheme);
                themeToggle.dataset.theme = newTheme;

                // If container style queries are supported, use CSS variable
                if (supportsContainerStyleQueries) {
                    document.documentElement.style.setProperty('--theme', newTheme);
                } else {
                    console.log('Container style queries not supported, using fallback method.');
                    // Fallback for Firefox: toggle class on body
                    document.body.classList.remove('theme-light', 'theme-dark');
                    document.body.classList.add(`theme-${newTheme}`);
                }
            }
        });
    </script>
</body>

</html>
