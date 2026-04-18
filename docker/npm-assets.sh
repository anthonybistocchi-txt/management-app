#!/bin/sh
set -e
cd /var/www/html

npm ci

# Lockfile gerado no Windows: npm ci no Linux pode não trazer o optional do Rollup 4
ROLLUP_VER=$(node -p "require('rollup/package.json').version")
case "$(uname -m)" in
  x86_64) npm install "@rollup/rollup-linux-x64-gnu@${ROLLUP_VER}" --no-save ;;
  aarch64|arm64) npm install "@rollup/rollup-linux-arm64-gnu@${ROLLUP_VER}" --no-save ;;
  *) echo "Arquitetura não suportada: $(uname -m)"; exit 1 ;;
esac

npm run build
