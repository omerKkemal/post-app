import os

list_of_artisan = [
    # === Server & Development ===
    "php artisan serve",
    "composer run dev",
    "php artisan down",
    "php artisan up",

    # === Authentication (Laravel 12+) ===
    # Breeze Installation
    "composer require laravel/breeze --dev",
    "php artisan breeze:install",
    "php artisan breeze:install vue",
    "php artisan breeze:install react",
    "php artisan breeze:install api",

    # Laravel UI Installation (optional)
    "composer require laravel/ui",
    "php artisan ui bootstrap",
    "php artisan ui bootstrap --auth",
    "php artisan ui vue",
    "php artisan ui vue --auth",
    "php artisan ui react",
    "php artisan ui react --auth",

    # === Migrations & Database ===
    "php artisan migrate",
    "php artisan migrate:rollback",
    "php artisan migrate:refresh",
    "php artisan db:seed",
    "php artisan make:migration",
    "php artisan make:seeder",

    # === Make Commands ===
    "php artisan make:model",
    "php artisan make:controller",
    "php artisan make:middleware",
    "php artisan make:request",
    "php artisan make:resource",
    "php artisan make:command",
    "php artisan make:event",
    "php artisan make:job",
    "php artisan make:listener",
    "php artisan make:policy",
    "php artisan make:provider",
    "php artisan make:test",

    # === Cache & Config ===
    "php artisan config:clear",
    "php artisan cache:clear",
    "php artisan route:clear",
    "php artisan view:clear",
    "php artisan optimize",

    # === Miscellaneous ===
    "php artisan route:list",
    "php artisan tinker",
    "php artisan queue:work",
    "php artisan schedule:run"
]

# === Recommended Workflows ===
recommended_workflows = {
    "breeze": [
        "composer require laravel/breeze --dev",
        "php artisan breeze:install",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ],
    "breeze_vue": [
        "composer require laravel/breeze --dev",
        "php artisan breeze:install vue",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ],
    "breeze_react": [
        "composer require laravel/breeze --dev",
        "php artisan breeze:install react",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ],
    "laravel_ui_bootstrap": [
        "composer require laravel/ui",
        "php artisan ui bootstrap --auth",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ],
    "laravel_ui_vue": [
        "composer require laravel/ui",
        "php artisan ui vue --auth",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ],
    "laravel_ui_react": [
        "composer require laravel/ui",
        "php artisan ui react --auth",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ],
    # === Auth Workflow ===
    "auth_workflow": [
        # Choose one: Laravel Breeze is preferred (UI is fallback)
        "composer require laravel/breeze --dev || composer require laravel/ui",
        "php artisan breeze:install || php artisan ui bootstrap --auth",
        "npm install",
        "npm run dev",
        "php artisan migrate"
    ]
}

def menu():
    print("\n=== Artisan Command Menu ===")
    for i, x in enumerate(list_of_artisan):
        print(f"{i} -> {x}")
    print("\n=== Recommended Workflows ===")
    for i, wf in enumerate(recommended_workflows.keys()):
        print(f"[WF-{i}] -> {wf} workflow")
    print("\nhelp -> Show menu")
    print("exit -> Quit program\n")

menu()

while True:
    user_input = input('[+] Enter index, WF-[n], or command (help/exit): ').strip()

    if user_input.lower() == 'help':
        menu()
        continue
    if user_input.lower() == 'exit':
        print("Exiting...")
        break

    # Handle workflows
    if user_input.startswith("WF-"):
        try:
            wf_index = int(user_input.split("-")[1])
            wf_key = list(recommended_workflows.keys())[wf_index]
            print(f"[+] Running workflow: {wf_key}")
            for cmd in recommended_workflows[wf_key]:
                print(f" -> {cmd}")
                os.system(cmd)
        except (IndexError, ValueError):
            print("[!] Invalid workflow index.")
        continue

    # Handle regular artisan commands
    if not user_input.isdigit():
        print("[!] Please enter a valid index number.")
        continue

    index = int(user_input)

    if index < 0 or index >= len(list_of_artisan):
        print("[!] Invalid index. Type 'help' to see available commands.")
        continue

    base_command = list_of_artisan[index]
    extra = input(f"[+] Additional arguments for '{base_command}' (leave empty if none): ").strip()
    full_command = f"{base_command} {extra}" if extra else base_command

    print(f"[+] Running: {full_command}")
    os.system(full_command)
# This script provides a menu-driven interface to run common Laravel Artisan commands and recommended workflows.
# Save this script as `my_artisan.py` and run it in your Laravel project directory.
# Ensure you have Python installed and accessible via your command line.
# Example usage:
# $ python my_artisan.py
