unit UJogo;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Grids, QExtCtrls, ExtCtrls;

type
  TfmJogoTP = class(TForm)
    Panel1: TPanel;
    tabuleiro: TStringGrid;
    procedure FormShow(Sender: TObject);
    procedure tabuleiroClick(Sender: TObject);
  private
    { Private declarations }
    function testaVez():string;
    function mapeiaJogada(linha,coluna:integer): boolean;
    function vencedorHorizontal():boolean;
    function vencedorVertical():boolean;
    function vencedorDiagonal1():boolean;
    function vencedorDiagonal2():boolean;
    function testaVencedor():boolean;
    procedure esvaziaTabuleiro();
  public
    { Public declarations }
  end;

var
  fmJogoTP: TfmJogoTP;
  mapaTabuleiro: array [1..19, 1..19] of integer;
  vez: boolean;

implementation

{$R *.dfm}


function TfmJogoTP.testaVez():string;
begin
  if vez = true then
  begin
    result := 'O';
    vez := false;
  end else
  begin
    result := 'X';
    vez := true;
  end;
end;

function TfmJogoTP.mapeiaJogada(linha,coluna:integer): boolean;
begin
  if mapaTabuleiro[linha,coluna] = 0 then
  begin
    if vez = true then
    begin
      mapaTabuleiro[linha,coluna] := 1;
      result := true;
    end else
    begin
      mapaTabuleiro[linha,coluna] := 2;
      result := true;
    end;
  end
  else
    result := false;
end;

function TfmJogoTP.vencedorHorizontal():boolean;
var i,j,a:integer;
begin
a := 0;
  for i := 1 to 19 do
  begin
    for j := 1 to 19 do
    begin
      if mapaTabuleiro[i,j] <> 0 then
      begin
        if ((mapaTabuleiro[i,j] = mapaTabuleiro[i+1,j])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i+2,j])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i+3,j])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i+4,j])) then
          a := 1;
      end;
    end;
  end;
  Result := a <> 0;
end;

function TfmJogoTP.vencedorVertical():boolean;
var i,j,a:integer;
begin
  a := 0;
  for i := 1 to 19 do
  begin
    for j := 1 to 19 do
    begin
      if mapaTabuleiro[i,j] <> 0 then
      begin
        if ((mapaTabuleiro[i,j] = mapaTabuleiro[i,j+1])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i,j+2])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i,j+3])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i,j+4])) then
          a := 1;
      end;
    end;
  end;
  Result := a <> 0;
end;

function TfmJogoTP.vencedorDiagonal1():boolean;
var i,j,a:integer;
begin
  a := 0;
  for i := 1 to 19 do
  begin
    for j := 1 to 19 do
    begin
      if mapaTabuleiro[i,j] <> 0 then
      begin
        if ((mapaTabuleiro[i,j] = mapaTabuleiro[i+1,j+1])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i+2,j+2])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i+3,j+3])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i+4,j+4])) then
          a := 1;
      end;
    end;
  end;
  Result := a <> 0;
end;

function TfmJogoTP.vencedorDiagonal2():boolean;
var i,j,a:integer;
begin
  a := 0;
  for i := 1 to 19 do
  begin
    for j := 1 to 19 do
    begin
      if mapaTabuleiro[i,j] <> 0 then
      begin
        if ((mapaTabuleiro[i,j] = mapaTabuleiro[i-1,j+1])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i-2,j+2])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i-3,j+3])
        and (mapaTabuleiro[i,j] = mapaTabuleiro[i-4,j+4])) then
          a := 1;
      end;
    end;
  end;
  Result := a <> 0;
end;

function TfmJogoTP.testaVencedor():boolean;
begin
  Result := false;
  if vencedorHorizontal = true then
    Result := true
  else if vencedorVertical = true then
    Result := true
  else if vencedorDiagonal1 = true then
    Result := true
  else if vencedorDiagonal2 = true then
    Result := true
  else Result := false;
end;

procedure TfmJogoTP.esvaziaTabuleiro();
var i,j:integer;
begin
  for i := 1 to 19 do
    for j := 1 to 19 do
      mapaTabuleiro[i,j] := 0;
end;

procedure TfmJogoTP.FormShow(Sender: TObject);
begin
  esvaziaTabuleiro;
end;

procedure TfmJogoTP.tabuleiroClick(Sender: TObject);
begin
  if mapeiaJogada(tabuleiro.Col+1,tabuleiro.Row+1) = true then
    tabuleiro.Cells[tabuleiro.Col,tabuleiro.Row] := testaVez;
  if testaVencedor then
    begin
      ShowMessage('Você venceu!');
      Application.Terminate;
    end;
end;

end.
