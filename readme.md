# Test JSON API (Laravel)

## Requirements

- PHP 5.x
- PostgreSQL 9.x

## Installation

- clone this repository
- navigate to project root and run `sh build.sh` in a console. This will install composer dependencies, perform database migrations and seed database
- edit .env file to configure your PostgreSQL connection
- set up your local server to point to **project root/public**

## API

All endpoints are accessed via POST method. Request body must be in JSON format.

**List of endpoints:**

- login - Authentication - `{"username": "test", "password": "test"}`
- friend/all - Show all friends
- friend/accept - Accept friend request - `{"user_id": 1}`
- friend/decline - Decline friend request - `{"user_id": 1}`
- friend/inbox - Show all friend requests from a user
- friend/outbox - Show all friend requests to a user
- friend/add - Make friend request - `{"user_id": 1}`
- friend/remove - Delete user from friends - `{"user_id": 1}`
- profile - Show user profile - `{"user_id": 1}`
- search - Search user - `{"query": "test"}`