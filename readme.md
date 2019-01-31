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

- Estates: view and edit created
