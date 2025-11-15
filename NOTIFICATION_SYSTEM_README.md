# Notification System Documentation

## Overview
The notification system automatically notifies users about their event registrations and upcoming events.

## Features

### 1. Registration Notifications
- When a user registers for an event, they automatically receive a notification
- Notification appears on the home page
- Message: "You have successfully registered for [Event Name]. Your payment is being verified."

### 2. Event Reminder Notifications
- **1 Day Before Event**: Users get notified one day before their registered event
- **Day of Event**: Users get notified on the day of the event

### 3. Notification Display
- Unread notifications appear at the top of the home page
- Shows up to 3 most recent notifications
- Users can mark individual notifications as read
- Users can view all notifications on a dedicated page

## How It Works

### For Users
1. **Register for an event** → Instant notification created
2. **View notifications** on the home page when logged in
3. **Mark as read** to dismiss notifications
4. **View all notifications** at `/notifications`

### For Administrators

#### Running Event Reminders Manually
To send event reminders manually, run:
```bash
php artisan events:send-reminders
```

#### Automated Daily Reminders
The system is configured to run automatically every day via Laravel's scheduler.

To enable automated reminders, you need to set up a cron job on your server:

**Linux/Mac:**
Add this line to your crontab (`crontab -e`):
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

**Windows (Task Scheduler):**
Create a scheduled task that runs every minute:
```
Program: C:\path\to\php.exe
Arguments: C:\path\to\project\artisan schedule:run
```

Alternatively, for development, you can run the scheduler continuously:
```bash
php artisan schedule:work
```

## Database Structure

### Notifications Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `event_id` - Foreign key to events table (nullable)
- `type` - Enum: 'registration', 'reminder_1day', 'reminder_today'
- `message` - Notification text
- `is_read` - Boolean flag
- `created_at`, `updated_at` - Timestamps

## Routes

### User Routes (Protected by Auth)
- `GET /notifications` - View all notifications
- `PATCH /notifications/{notification}/mark-read` - Mark single notification as read
- `POST /notifications/mark-all-read` - Mark all notifications as read

## Models and Relationships

### User Model
- `notifications()` - Has many notifications
- `unreadNotifications()` - Has many unread notifications

### Notification Model
- `user()` - Belongs to User
- `event()` - Belongs to Event

### Event Model
- Already has relationships for registrations

## Customization

### Changing Notification Messages
Edit `app/Console/Commands/SendEventReminders.php` to customize reminder messages.

### Changing When Reminders Are Sent
Modify `routes/console.php` to change the schedule:
```php
// Daily at 9 AM
Schedule::command('events:send-reminders')->dailyAt('09:00');

// Every hour
Schedule::command('events:send-reminders')->hourly();

// Twice daily
Schedule::command('events:send-reminders')->twiceDaily(9, 18);
```

## Testing

1. **Test Registration Notification:**
   - Register for an event as a user
   - Check home page for notification

2. **Test Event Reminders:**
   - Create an event with start_date = tomorrow
   - Run: `php artisan events:send-reminders`
   - Check user's notifications

3. **Test Mark as Read:**
   - Click "Mark as Read" button
   - Notification should disappear from home page

## Troubleshooting

### Notifications Not Showing
- Ensure user is logged in
- Check if migration ran: `php artisan migrate:status`
- Verify relationships in User model exist

### Reminders Not Sending
- Run command manually: `php artisan events:send-reminders`
- Check if events have valid start_date
- Ensure users have verified registrations
- Check if cron job is running: `php artisan schedule:list`

### Performance Issues
- Add database indexes if needed
- Consider using Laravel Horizon for queue management
- Archive old notifications periodically

## Future Enhancements
- Email notifications
- Push notifications
- SMS notifications
- Notification preferences per user
- Notification categories and filters
