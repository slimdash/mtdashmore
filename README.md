# mtdashmore
More than just a simple Dashboard.  A good saas panel starter project.

- [x] f3 framework - fatfree framework
- [x] firebase auth
- [x] REST api starter backend

## intro
In order to support multi-tenant/client/projects, we are defining that the term: Project = Tenant

Home Controller (index.php)
- to present a login screen.

MainDashboard Controller (api/setting.php)
- to present a dashboard
- to manage global modules

ProjectDashboard Controller (api/project.php)
- to manage a project settings
- to manage a project modules

Modules are your SAAS APPs.

### permissions
* A User has many Projects
* A Project has many Modules
* A User can have access to a Project, but may be excluded from a particular Module.

## to run
```
php -S 0.0.0.0:8888 -t public
```

# LICENSE
GPL-3.0 due to FatFree Framework restriction.