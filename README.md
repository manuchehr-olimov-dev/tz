{
  "openapi": "3.0.0",
  "info": {
    "title": "Your API Documentation",
    "version": "1.0.0"
  },
  "paths": {
    "/requests/": {
      "get": {
        "summary": "Retrieve requests by responsible party",
        "parameters": [
          {
            "name": "status",
            "in": "query",
            "description": "Filter requests by status",
            "schema": {
              "type": "string"
            }
          }
        ],
        "responses": {
          "200": {
            "description": "Successful response",
            "content": {
              "application/json": {
                "example": {
                  "requests": []
                }
              }
            }
          }
        }
      },
      "post": {
        "summary": "Submit a new request",
        "requestBody": {
          "required": true,
          "content": {
            "application/json": {
              "example": {
                "user": "username",
                "description": "Request details"
              }
            }
          }
        },
        "responses": {
          "201": {
            "description": "Request successfully created"
          }
        }
      }
    },
    "/requests/{id}/": {
      "put": {
        "summary": "Respond to a specific task",
        "parameters": [
          {
            "name": "id",
            "in": "path",
            "description": "ID of the request",
            "required": true,
            "schema": {
              "type": "string"
            }
          }
        ],
        "requestBody": {
          "required": true,
          "content": {
            "application/json": {
              "example": {
                "response": "Task response details"
              }
            }
          }
        },
        "responses": {
          "200": {
            "description": "Successful response",
            "content": {
              "application/json": {
                "example": {
                  "message": "Response recorded"
                }
              }
            }
          }
        }
      }
    }
  }
}