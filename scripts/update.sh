#!/bin/bash
source ~/.nvm/nvm.sh

# check for package.json
if [ ! -f package.json ]; then
  echo "package.json not found! Please run this script in the project root directory."
  exit 1
fi

nvm use 22
git pull
bun install
bun run build
rm -rf node_modules
