# Gateway Change Notifier Script

This PHP script monitors changes in the pfSense default gateway and notifies a Google Chat room when a change occurs. It uses a Google Chat webhook to send alerts whenever the default gateway changes.

## Features
- Monitors the system's default gateway.
- Compares the current gateway with the previously used gateway.
- Sends a notification to Google Chat if the gateway has changed.
- Provides the gateway's friendly name in the notification.

## Prerequisites
1. pfSense (obviously)
2. Google Chat webhook URL for posting notifications. To create, follow this guid: https://help.moveworkforward.com/google-workspace/how-to-create-google-chat-incoming-webhook-for-g-1
3. Proper permissions to read/write `/root/previous_gateway.txt`.

## Setup

1. **Place the Script**
   Save the script to a suitable directory and make it executable:
   ```bash
   chmod +x /path/to/script.php
