#!/usr/bin/env bash

./craft install --interactive=0 \
  --email="${ADMIN_USER}" \
  --username="${ADMIN_USER}" \
  --password="${ADMIN_PASSWORD}" \
  --siteName="${SITE_NAME}" \
  --siteUrl="${SITE_URL}"
