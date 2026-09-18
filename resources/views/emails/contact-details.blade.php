<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Information</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f7; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; padding: 30px; border: 1px solid #e2e8f0; }
        .header { border-bottom: 2px solid #4f46e5; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { color: #1e293b; margin: 0; }
        .info-group { margin-bottom: 15px; }
        .info-label { font-weight: bold; color: #64748b; font-size: 13px; text-transform: uppercase; }
        .info-value { font-size: 16px; color: #0f172a; margin-top: 4px; }
        .footer { margin-top: 30px; pt-4; border-top: 1px solid #e2e8f0; font-size: 12px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>EduRide — Advertisement Contact Details</h2>
        </div>

        <p>Hello,</p>
        <p>Here are the requested contact details for the following advertisement on EduRide:</p>

        <div class="info-group">
            <div class="info-label">Advertisement Title</div>
            <div class="info-value"><strong>{{ $ad->title }}</strong></div>
        </div>

        <div class="info-group">
            <div class="info-label">Category / Subject</div>
            <div class="info-value">{{ $ad->category->name ?? 'N/A' }} — {{ $ad->subject->name ?? 'N/A' }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">Location</div>
            <div class="info-value">{{ $ad->location->name ?? $ad->city ?? 'N/A' }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">Contact Phone</div>
            <div class="info-value">{{ $ad->contact_phone ?? 'N/A' }}</div>
        </div>

        <div class="info-group">
            <div class="info-label">Contact Email</div>
            <div class="info-value">{{ $ad->contact_email ?? 'N/A' }}</div>
        </div>

        @if($ad->fee_min || $ad->fee_max)
        <div class="info-group">
            <div class="info-label">{{ $ad->type === 'student_requirement' ? 'Budget' : 'Fee' }}</div>
            <div class="info-value">AED {{ $ad->fee_min }} - {{ $ad->fee_max }} {{ $ad->fee_type ? '/ ' . $ad->fee_type : '' }}</div>
        </div>
        @endif

        <div class="footer">
            <p>Thank you for using EduRide. Connecting students with qualified tutors across UAE.</p>
        </div>
    </div>
</body>
</html>
