SELECT * FROM tracks;
SELECT * FROM artists;

SELECT track_id, name, composer, milliseconds
FROM tracks;

-- Display tracks that cost more than 0.99. 
-- Sort from shortest to longest (in length)
SELECT * FROM tracks
WHERE tracks.unit_price > 0.99
ORDER BY tracks.milliseconds ASC;

-- Display tracks that have a composer
-- Only show track's id, name, composer, and price
SELECT track_id, name, composer, unit_price 
FROM tracks
WHERE composer IS NOT NULL;

-- Display tracks that have 'you' or 'day' in their titles
SELECT * FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';

-- Display tracks composed by U2 that have 'you' or 'day'
-- in their titles
SELECT * FROM tracks
WHERE (name LIKE '%you%' OR name LIKE '%day%')
AND composer LIKE '%u2%';

SELECT * FROM albums;
SELECT * FROM artists;

-- JOIN albums & artists tables together
-- so we can see their info together
SELECT * FROM albums
JOIN artists
ON artists.artist_id = albums.artist_id; 

-- refine names
SELECT album_id, title AS album_title, name AS artist_name
FROM albums
JOIN artists
ON artists.artist_id = albums.artist_id;

-- Display all Jazz tracks
SELECT * FROM tracks
WHERE genre_id = 2;

-- Display all Jazz tracks
-- Show track_name, genre, album title,artist name
SELECT tracks.name AS track_name, genres.name AS genre_name, albums.title AS album_name, artists.name AS artist_name
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN albums
	ON tracks.album_id = albums.album_id
JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;
