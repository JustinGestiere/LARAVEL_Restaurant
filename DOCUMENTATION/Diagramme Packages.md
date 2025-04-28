```mermaid
graph TD

    subgraph App
        Http_Controllers[Http\Controllers]
        Models
        Providers
        Policies
    end

    subgraph Ressources
        Views
        Lang
        Js
        Css
    end

    subgraph Database
        Migrations
        Seeders
        Factories
    end

    subgraph Config
        Auth[auth.php]
        DatabaseConf[database.php]
        AppConf[app.php]
    end

    subgraph Routes
        Web[web.php]
        API[api.php]
    end

    Http_Controllers --> Models
    Http_Controllers --> Views
    Http_Controllers --> Policies
    Models --> Migrations
    Views --> Js
    Views --> Css
    Providers --> Policies
    Web --> Http_Controllers
    API --> Http_Controllers
    Database --> Migrations
    Database --> Seeders
    Database --> Factories
    Config --> Providers
```