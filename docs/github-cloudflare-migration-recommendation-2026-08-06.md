# GitHub + Cloudflare移行判断（2026-08-06）

## 結論

WordPressから、GitHubで管理するAstro静的サイトをCloudflare Pagesへ移行する方針を推奨する。

ただし、ホスティング変更だけで検索露出が増えるわけではない。SEOの主施策は、フランス語コンテンツの公開、内部リンク、正確なメタデータ、インデックス確認である。移行は表示速度、保守性、セキュリティ、変更履歴、ロールバック性を改善する基盤整備として扱う。

## 現状

- `uk-eta-fr` はAstro 6の静的サイトとしてビルド可能。
- 現在25ページを生成でき、ETA解説記事、渡航情報、ビザ情報、法的情報を含む。
- GitHubリポジトリ `mm-user01208/uk-eta-fr` は既に存在する。
- Cloudflare PagesはGitHub連携、コミットごとの自動ビルド、プレビューURL、ロールバックに適する。
- 現在のWordPress本番URLは非www（`https://eudiasporacouncil.org`）を正規URLとしている。
- 申請、問い合わせ、ステータス確認を含め、現状は動的フォームが存在しない。全ページを静的配信できるため、Workersやデータベースは移行対象外。

## 2026-08-06 実装進捗

- Astroの正規URLとサイトマップを非wwwへ統一。
- 既存WordPress URLを静的ルートとして追加。
- 新設ルートと既存ルートが重なるページに1対1の301を追加。
- HTMLサイトマップを追加。
- Cloudflare用セキュリティヘッダーを追加。
- Astroと関連パッケージを更新し、`npm audit` 0件を確認。
- 33ルートの静的ビルドに成功。

## 切替前の必須修正

1. Astroの `site` と `robots.txt` がwwwを向いているため、非wwwへ統一する。
2. 既存URLを原則維持する。少なくとも `/service/`、`/fee/`、`/privacy/`、`/mentions-legales/`、`/agreement/`、`/page_cat/uketa/`、`/page_cat/site/` の同等ページまたは1対1の301を用意する。
3. `www -> 非www`、HTTP -> HTTPSを1回の301で統一し、リダイレクトチェーンを作らない。
4. 現在のGA4同意管理をAstro版へ移植する。
5. Search Console所有権確認用ファイルまたはタグを保持する。
6. `sitemap-index.xml` を非wwwで生成し、切替後にSearch Consoleへ再送信する。
7. 404ページ、セキュリティヘッダー、OG画像、favicon、構造化データを確認する。
8. 将来フォームを追加する場合、フォームや個人情報をGitHubへ保存しない。Cloudflare Workers/Pages Functions等のバックエンドへ分離し、秘密情報はCloudflare Secretsで管理する。
9. `npm audit` で報告される依存関係の問題を確認・更新してから公開する。

## 推奨する移行方法

1. Astro版をCloudflare PagesのプレビューURLで公開する。
2. 全既存URLについて、HTTPステータス、canonical、title、description、本文、内部リンクをWordPress版と比較する。
3. DNS切替時にはドメインと主要URLを変えず、まずホスティング/CMSだけを変更する。
4. 切替直後に本番クロール、フォーム、GA4、Search Console、サイトマップを確認する。
5. 問題がなければWordPressを一定期間保持し、その後停止する。
6. 新しいフランス語記事は切替後も継続公開する。

## 判断

現時点は「移行推奨・本番切替は未承認」。上記の必須修正とプレビュー検証が完了してからDNSを切り替える。

## 公式資料

- [Cloudflare Pages: Astro](https://developers.cloudflare.com/pages/framework-guides/deploy-an-astro-site/)
- [Cloudflare Pages: Redirects](https://developers.cloudflare.com/pages/configuration/redirects/)
- [Google: ホスティング変更時のSEO](https://developers.google.com/search/docs/crawling-indexing/site-move-no-url-changes)
- [Google: URL変更を伴うサイト移行](https://developers.google.com/search/docs/crawling-indexing/site-move-with-url-changes)
