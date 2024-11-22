# FiveM Dynamic Signature

A dynamic signature generator for FiveM, allowing server owners and players to create customizable, real-time signatures displaying in-game stats such as player name, level, kills, money, and more. This tool is perfect for adding a personal touch to player profiles or integrating into community websites, forums, and Discord. Easily customizable and built for seamless integration with FiveM servers.

---

## Features

- **Real-Time Data**: Generates dynamic signatures using live in-game data from the FiveM server.
- **Customizable**: Customize the signature’s appearance, including fonts, colors, and layout.
- **Supports Key Player Stats**: Display key information like player name, level, kills, money, and more.
- **Easy Integration**: Integrates easily into community websites, forums, or Discord profiles.
- **Fully Responsive**: Responsive to different screen sizes for optimal display across devices.

---

## Installation

### Prerequisites

1. **FiveM Server**: Ensure you have a FiveM server running.
2. **PHP**: This script requires PHP to run.
3. **MySQL Database**: You'll need to connect the script to your MySQL database to retrieve player data.

### Steps

1. Clone the repository to your server:
    ```bash
    git clone https://github.com/orisegev/fivem-dynamic-signature.git
    ```

2. Set up your MySQL database and configure the connection in the `config.php` file.

3. Customize the design and layout of your signature by editing the `image_create.php` file or adding custom CSS.

4. Embed the generated signature on your website or forum by copying the image URL or directly embedding the image using HTML:
    ```html
    <img src="signature.php?user_id=player_id" alt="Player Signature">
    ```

---

## Usage

To generate a dynamic signature for a player, simply pass the player's unique `user_id` in the query string of the signature generator. For example:
```html
<img src="signature.php?user_id=player_id" alt="Player Signature">
