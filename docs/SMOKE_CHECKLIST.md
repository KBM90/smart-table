# Production smoke checklist

This checklist applies to the Smart Table SaaS project at `C:\Karim\projects\Saas\smart-table`.

## Preconditions

- production env created from `C:\Karim\projects\Saas\smart-table\.env.production.example`
- migrations executed
- assets built
- `php artisan config:cache`, `php artisan route:cache`, and `php artisan view:cache` completed successfully
- HTTPS enabled

## Steps

1. Visit `/`.
   - Expected: redirects to `/login`.
2. Register a new business owner.
   - Expected: owner lands on `/dashboard` and sees the tenant name.
3. Create a table from the owner dashboard.
   - Expected: QR PNG downloads successfully.
   - Verify: open the PNG and scan it with a real phone.
4. Open the scanned URL on a phone.
   - Expected: the public table page loads in a mobile-friendly layout and shows `Call Waiter`.
5. Tap `Call Waiter`.
   - Expected: the customer request status view appears and the timer starts counting.
6. In another browser, log in as the owner and open `/owner/requests`.
   - Expected: the pending request appears within 10 seconds.
7. Accept the request as owner.
   - Expected: the customer page updates within 10 seconds and shows an accepted state.
8. Mark the table free.
   - Expected: the current customer session ends and the table can be scanned again for a fresh session.
9. Create one product with a library image and one with an uploaded image.
   - Expected: both product images load from the catalog over HTTPS.
10. Create a waiter account, sign in as that waiter, and open `/waiter/dashboard`.
    - Expected: waiter sees waiter request screens only and cannot access `/owner/*`.
11. Run login rate-limit probes with 6 failed login attempts from the same IP.
    - Expected: the sixth attempt returns HTTP `429`.
12. Verify transport and headers.
    - Expected: HTTPS is active, HSTS is recommended, and there is no mixed content in the browser console.