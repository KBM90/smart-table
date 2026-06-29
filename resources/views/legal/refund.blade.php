@extends('layouts.guest')

@section('content')
    <x-legal.chrome title="Refund Policy" eyebrow="Billing">
        <p>
            This Refund Policy explains how trials, subscriptions, cancellations, and refund requests work for Smart Table.
        </p>

        <h2>1. Free Trial</h2>
        <p>
            Smart Table may offer a free trial so restaurants can evaluate the service before subscribing. When the trial ends, operational access may be restricted until a paid plan is activated. A payment method is not required for the initial free trial unless stated at checkout.
        </p>

        <h2>2. Subscription Billing</h2>
        <p>
            Paid subscriptions renew automatically on the billing cycle selected at checkout, such as monthly or annual. The price, billing period, taxes, and payment method are shown before purchase. Payments are processed by Paddle or the payment provider shown at checkout.
        </p>

        <h2>3. Cancellations</h2>
        <p>
            You may cancel your subscription at any time from the billing area of the owner dashboard or by contacting support at support@smartable.space. Cancellation stops future renewals. Unless required by law or stated otherwise, cancelling does not automatically refund the current billing period, and access may continue until the end of the paid period.
        </p>

        <h2>4. Refund Eligibility</h2>
        <p>
            Subscription fees are generally non-refundable once a billing period has started. We may approve refunds when required by law, when there is a duplicate or mistaken charge, when a billing error is confirmed, or when Smart Table is materially unavailable due solely to our systems and we cannot reasonably resolve the issue.
        </p>

        <h2>5. Refund Requests</h2>
        <p>
            To request a refund, email <a href="mailto:support@smartable.space">support@smartable.space</a> within 14 days of the charge. Include the account owner's email address, venue name, charge date, plan, and reason for the request. We may ask for additional information to verify the account and transaction.
        </p>

        <h2>6. Annual Plans</h2>
        <p>
            Annual plans are purchased for a discounted yearly term. Unless required by law or approved under this policy, annual plan payments are not prorated or refunded after the billing period begins.
        </p>

        <h2>7. Processing Approved Refunds</h2>
        <p>
            Approved refunds are issued to the original payment method through Paddle or the payment provider. Processing times depend on the payment provider, card network, bank, and country.
        </p>

        <h2>8. Chargebacks</h2>
        <p>
            If you believe a charge is incorrect, please contact us first so we can investigate quickly. Chargebacks may cause account access or billing status to be paused while the payment provider reviews the dispute.
        </p>

        <h2>9. Contact</h2>
        <p>
            Billing and refund questions can be sent to <a href="mailto:support@smartable.space">support@smartable.space</a>.
        </p>
    </x-legal.chrome>
@endsection
