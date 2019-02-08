# Real Estate Agency Site and Management System

Author: [Alex Neverov](al_neverov@live.ru)

This project is featured with:

- Laravel 5.7
- Bootstrap 4.1.3
- TinyMCE
- select2

Additional Laravel packages:

- laravelcollective/html
- mews/purifier
- intervention/image

Main functionality:

- Front-end must represent a catalog of the estate objects which may be sold or rented.
- The unauthorized users must have a possibility to contact with realtors using contact forms linked with specific estate objects.
- The system must have an interface for administrators and realtors which can access its functionality after authorization.
- The authorized users must have a possibility to manage the catalog by adding, modifying and deleting estate objects.
- Each estate object must be represented by its own card.
- The object's card must contain the full information about the specific objects including its characteristics and remarks made by administrators and realtors.
- The authorized users must have a possibility to look through the archive data of the sold objects.
- The system must provides flexible tools for searching and filtering of the objects for all categories of the users.
- The system must provides tools for some analytics which must be accessible for the authorized users.

## Development Log

### 2019-01-30

- The basic front-end structure was created.
- The authentication possibilities were added.
- The administrators interface was secured using authentication.
- Migrations for a catalog of estate objects were created with necessary seeders.
- Relationships between models are described.
- Locations: CRUD implemented.
- Estate types: CRUD implemented.

For estates:

- Select2 library was installed and used for the locations selection.
- TinyMCE editor was installed and used to edit text fields.
- List view and Create from are created.

### 2019-01-31

- The CRUD operations for Estates are implemented.
- To delete estates objects, soft deleting is used with standard mechanics of Laravel.
- The search form for Estates was created.

### 2019-02-01

- Some additional fields are added into the table 'estates'.
- The restore function for estates was implemented.
- Main page was added with a search form.
- The main images for the estates are added.
- The page for a single estate was basically created.
- Some UI issues were fixed.

TODO::

- Localization!
- UI: make message forms to functionate: they should send messages using AJAX, so, API-controller for messages need be created.
- Remarks for estate objects: CRUD and interface.

### 2019-02-02

Localization:

- The routing and middleware were prepared for the localization.
- The controllers and the views were fixed according the new requirements of the routing.
- Localization of the UI was started.
- Auth routing were fixed because of localization.

In addition:

- Search forms handling was fixed.

### 2019-02-03

- AJAX form for messages was added on the estate's page.

### 2019-02-04

Fix day :)

- Fix SASS to make all elements of design responsive.
- Fix SASS for admin panel: estates list, estate view etc.

### 2019-02-07

After a conversation with a realtor:

- The structure of the database and the migrations were revised.
- As a consequence, the UI elements were changed.

TODO:: add a new information onto the front-end.

### 2019-02-08

- The new estate parameters were added in front-end pages.
- Localization & styling of the CP in progress.....
