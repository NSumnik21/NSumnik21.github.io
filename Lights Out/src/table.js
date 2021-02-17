import $ from 'jquery';
import {parse_json} from './parse_json';

export const Table = function(sel){

    $(sel + " td button").click(function(event) {
        event.preventDefault();

        var loc = this.value.split(',');
        var r = loc[0];
        var c = loc[1];

        $.ajax({
            url: "game-post.php",
            data: {cell: r + ',' + c},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.table);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });

    var form = $(sel + " form");

    $(sel + " button.check").click(function(event){
        event.preventDefault();

        $.ajax({
            url: "game-post.php",
            data: {check: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.page);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });

    $(sel + " button.clear").click(function(event){
        event.preventDefault();

        $.ajax({
            url: "game-post.php",
            data: {clear: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.page);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });

    $(sel + " button.solve").click(function(event){
        event.preventDefault();

        $.ajax({
            url: "game-post.php",
            data: {solve: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.page);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });

    $(sel + " button.no").click(function(event){
        event.preventDefault();

        $.ajax({
            url: "game-post.php",
            data: {no: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.page);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });

    $(sel + " button.solve_yes").click(function(event){
        event.preventDefault();

        $.ajax({
            url: "game-post.php",
            data: {solve_yes: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.page);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });

    $(sel + " button.clear_yes").click(function(event){
        event.preventDefault();

        $.ajax({
            url: "game-post.php",
            data: {clear_yes: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                $(sel).html(json.page);
                var newTable = new Table(sel);
            },
            error: function(xhr, status, error){

            }
        });
    });
}