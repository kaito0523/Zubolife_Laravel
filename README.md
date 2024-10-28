# ZuboLife

ZuboLifeは、一人暮らしの人に向けた、ズボラな生活をサポートするためのWebアプリケーションです。

**URL**
- http://zuboralife.com/

## 使用技術 (Technologies Used)

- **Docker**：アプリケーションのコンテナ化および依存関係の管理
- **Docker Compose**：複数コンテナのオーケストレーション（Nginx、PHP、MySQL、Redisなど）
- **PHP 8.3**：アプリケーションロジックの実装言語
- **Laravel**：PHPフレームワーク、APIとデータベース処理のためのフレームワーク
- **Nginx**：ウェブサーバおよびリバースプロキシ
- **MySQL**：データベース
- **Redis**：キャッシュやセッション管理のインメモリデータストア
- **Tailwind CSS**：UIのスタイリング
- **JavaScript**：クライアントサイドの操作とライブラリ管理
- **Google Font API & Bootstrap Icons**：フォントとアイコン
- **AWS (EC2)**：EC2でのアプリケーションホスティング

## 機能一覧 (Features)

| 機能                         | 説明                                                                                                    | デモ                                                                                           |
|------------------------------|---------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------|
| **レシピ一覧表示**           | ホーム画面にユーザー投稿のレシピを一覧表示。各レシピには画像、名前、説明が表示                         | <img src="README_pic/recipeList.png" alt="recipeList" width="550">                           |
| **レシピ詳細表示**           | レシピを選択すると詳細画面を表示。詳細には画像、名前、説明、材料、作り方、参考URLを含む               | <img src="README_pic/recipeShow.png" alt="recipeDetail" width="550">                       |
| **レシピ投稿**               | ユーザーが新しいレシピを投稿可能。画像、名前、説明、材料、作り方を入力できるフォームを提供           | <img src="README_pic/recipeCreate.png" alt="recipePost" width="550">                           |
| **レシピお気に入り機能**     | レシピをお気に入り登録してリストに保存。お気に入り登録したレシピの一覧表示                           | <img src="README_pic/recipeFavorite.png" alt="favorites" width="550">                             |
| **買い物メモ作成機能**       | 材料を買い物メモに追加可能。メモには材料リストや自由に追加できるメモ欄が含まれる                     | <img src="README_pic/memoCreate.png" alt="memoAdd" width="550">                                 |
| **買い物メモの管理**         | 作成した買い物メモをリストで表示。メモの編集、削除が可能                                             | <img src="README_pic/memoShow.png" alt="memoManage" width="550">                           |
| **ユーザー認証機能**         | ユーザー登録、ログイン、ログアウト機能。ゲストユーザーも閲覧可能だが、投稿やお気に入り機能はログインが必要 | <img src="README_pic/login.png" alt="authentication" width="550">                  |
| **レシピ検索・フィルタリング**| 材料を基にレシピを検索・フィルタリング。複数の材料やタグでの絞り込みが可能                          | <img src="README_pic/filter.png" alt="searchFilter" width="550">                       |
| **タグ機能**                 | レシピに「10分以内にできる」「材料3つ以内」などのタグを追加。簡単で素早く作れるレシピが検索可能     |                |

---

このアプリケーションを通して、料理レシピの管理・共有が効率化され、ユーザーが簡単にレシピを投稿・閲覧・保存できる環境を提供します。
