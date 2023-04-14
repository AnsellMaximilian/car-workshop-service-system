# Car Workshop Sales System for Bengkel Sogo Jaya AC

## Background

The purpose of this document is to provide a technical overview of the sales system used to computerize the sales process of a car workshop named Bengkel Sogo Jaya AC. This system is designed to automate the registration of service requests, track spare part inventory, generate invoices, and store customer data. The system is built using Laravel, Livewire, and Tailwind, with MySQL as the database.

## Current Working System

During the analysis phase, it was discovered that this was the current employed to process sales, as displayed as an activity diagram:
![image](https://user-images.githubusercontent.com/56351143/231940380-5f9a8ba5-0b53-4135-a5a3-638dd95f029b.png)


## Sugested New System

To overcome the weaknesses of the currently employed system, it is suggested that the workshop use a new system. Here is the proposed activity diagram:

![image](https://user-images.githubusercontent.com/56351143/231940564-17b38075-8d11-4553-9ace-272103069df6.png)


## Requirements and Functionalities

Based on the suggested system, here are the requirements:

### Use Cases

![image](https://user-images.githubusercontent.com/56351143/231940742-d0f40b9b-0336-42fb-a8fd-bece0f0d7545.png)

#### Requirements

Here are a simplified list of the system's requirements:

- Registration System:
The system allows customers to register for a service at a specified date. Once a customer has registered, the system will notify the admins if there are users who registered.

- Service Registration:
The system enables the creation, storage, and updating of service registrations. This functionality allows the admins to track service requests and manage them efficiently.

- Service Data:
The system provides a way to create, store, and update service data. This functionality enables the admins to track the types of services provided, their cost, and other relevant information.

- Spare Parts Inventory:
The system allows the creation, storage, and updating of spare parts. This functionality enables the admins to keep track of spare part inventory stock.

- Service Types:
The system provides a way to create, store, and update service types. This functionality enables the admins to track the types of services provided and their costs.

- Customer Data:
The system enables the creation, storage, and updating of customer data. This functionality enables the admins to keep track of customer information, such as their name, contact information, and service history.

- Invoice Generation:
The system generates invoices for services rendered. This functionality enables the admins to bill customers for services rendered and provides a record of financial transactions.


## Architecture

The sales system is a web application built using the Laravel framework, with Livewire and Tailwind as the front-end frameworks. The system uses MySQL as the database, providing a robust and scalable solution for storing and retrieving data.

![Architecture](https://user-images.githubusercontent.com/56351143/231941594-18f0285a-735b-4329-95d6-2b40e74c9fdd.png)


## Data Model

The data model for the sales system consists of tables for service registrations, service data, spare parts inventory, service types, customer data, and invoices. These tables store the necessary data to facilitate the sales process, track inventory, and generate invoices.

![image](https://user-images.githubusercontent.com/56351143/231940866-5129eb58-a75b-42b2-9469-85aaadfd2da8.png)



## Design

The design of the sales system is based on the Tailwind CSS framework, providing a clean and modern interface. The user interface enables the admins to manage service requests, track spare part inventory, manage customer data, and generate invoices efficiently.

## Implementation

### Login Page

![image](https://user-images.githubusercontent.com/56351143/231941648-7ce28008-13a2-447e-b760-3e8cb0acd94b.png)


### Main page

![image](https://user-images.githubusercontent.com/56351143/231941681-539b0ad2-ae15-4d12-a0ce-a1efe911580b.png)


### Service Pages

![image](https://user-images.githubusercontent.com/56351143/231941782-8acd716c-0eb4-478b-859f-498466990484.png)


