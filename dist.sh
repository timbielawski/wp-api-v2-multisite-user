#!/usr/bin/env bash

rm ../wp-api-v2-multisite-user-plugin.zip

zip -r ../wp-api-v2-multisite-user-plugin.zip . --exclude .\* --exclude dist.sh
