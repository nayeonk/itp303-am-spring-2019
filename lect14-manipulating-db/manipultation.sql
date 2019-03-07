-- Add album Fight On by artist Spirit of Troy
SELECT * FROM albums
ORDER BY album_id desc;

SELECT * FROM artists
WHERE name LIKE '%spirit%';

-- Artist Spirit of Troy does not exist. Create one.
INSERT INTO artists(name)
VALUES ('Spirit of Troy');

INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276);

SELECT * FROM tracks;

-- Update track 'For Those about To Rock'. 
-- Change its composer to Tommy Trojan 
-- Change its album to 'Fight On'
UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
-- WHERE name = 'For Those About To Rock (We Salute You)';
WHERE track_id = 1;

SELECT * FROM albums
ORDER BY album_id DESC;
-- Search to get specific track id
SELECT * FROM tracks
WHERE name LIKE '%for%';

-- DELETE Forgiven track
-- Before deleting, good idea to check the track id
SELECT * FROM tracks
WHERE track_id = 43;

-- Delete won't work because track_id 43 is referenced in another table
DELETE FROM tracks
WHERE track_id = 43;

-- Create a view that displays all albums and the 
-- artist name. Show album_id, album title and artist name
CREATE OR REPLACE VIEW album_artists AS
SELECT albums.album_id, albums.title, artists.name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
ORDER BY artists.name DESC;
    
-- "Call" the view we just created. It re-runs the view.
SELECT * FROM album_artists;

-- How many tracks are there?
SELECT COUNT(*)
from tracks;

-- How many tracks? How many composers?
SELECT COUNT(*) AS tracks, COUNT(composer) AS composers
FROM tracks;

SELECT MAX(milliseconds), MIN(milliseconds), AVG(milliseconds)
FROM tracks;

-- How long is one specific album?
SELECT SUM(milliseconds) FROM tracks
WHERE album_id = 1;

-- Find the shortest track for EACH album
SELECT album_id, SUM(milliseconds) 
FROM tracks
GROUP BY album_id;


