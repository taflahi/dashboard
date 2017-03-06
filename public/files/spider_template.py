# -*- coding: utf-8 -*-
import scrapy

class PrestaSpider(scrapy.Spider):
    name = "Presta"  # Name of the Spider, required value
    start_urls = ["_start_url"]  # The starting url, Scrapy will request this URL in parse

    # Entry point for the spider
    def parse(self, response):
        for href in response.css('_product_url').xpath('@href'):
            url = "_base_url" + href.extract()
            print(url)
            yield scrapy.Request(url, callback=self.parse_item)

        nextlink = response.css('_next_url').xpath('@href').extract()
        if(len(nextlink) > 0):
            yield scrapy.Request("_base_url" + nextlink[0], callback=self.parse)
        

    # Method for parsing a product page
    def parse_item(self, response):
        yield {
            'Code': response.css('_code').extract()[0],
            'Author': response.css('_category::text').extract()[0].strip(),
            'Name': response.css('_name::text').extract()[0],
            'Price': response.css('_price::text').extract()[0].strip(),
            'Image': response.css('_image').xpath('@src').extract()[0],
            'Url': response.url
        }