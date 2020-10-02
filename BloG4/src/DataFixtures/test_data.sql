INSERT INTO category(created_on_id, label, created_at) VALUES
('1', 'HTML', now()),
('1', 'CSS', now()),
('1', 'JS', now()),
('1', 'JAVA', now()),
('1', 'C', now()),
('1', 'C++', now()),
('1', 'C#', now()),
('1', 'SQL', now()),
('1', 'PHP', now());

INSERT INTO article(created_on_id, title, picture, content, lst_categories, created_at) VALUES
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[1]', '2020-01-01 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[2]', '2020-01-02 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[3]', '2020-01-03 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[4]', '2020-01-04 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[5]', '2020-01-05 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[6]', '2020-01-06 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[7]', '2020-01-07 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[8]', '2020-01-08 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[9]', '2020-01-09 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[1,2]', '2020-01-10 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[3,4]', '2020-01-11 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[5,6]', '2020-01-12 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[7,8]', '2020-01-13 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[1,2,3]', '2020-01-14 00:00:00'),
('1', 'Title of the news', 'pictures/article/test.jpg', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis cum soluta nobis est eligendi placeat facere aut rerum.', '[4,5,6]', '2020-01-15 00:00:00');

INSERT INTO comment(fiche_id, created_on_id, content, created_at) VALUES
('1', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-01 00:00:00'),
('1', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-02 00:00:00'),
('2', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-01 00:00:00'),
('2', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-02 00:00:00'),
('3', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-01 00:00:00'),
('3', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-02 00:00:00'),
('4', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-01 00:00:00'),
('4', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-02 00:00:00'),
('5', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-01 00:00:00'),
('5', '1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2020-02-02 00:00:00');
